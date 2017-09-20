<?php

namespace AppBundle\Providers\ExternalDataProviders;

use AppBundle\AppBundle;
use AppBundle\Entity\ExternalProviderReviewRawData;
use AppBundle\Entity\ExternalProviderProductRawData;
use AppBundle\Entity\ExternalProvider;
use AppBundle\Entity\Product;
use AppBundle\Entity\Review;
use AppBundle\Model\ExternalDataProviders\ConsumeRawData;
use AppBundle\Repository\ExternalProviderProductRawDataRepository as ProductRepo;
use AppBundle\Repository\ExternalProviderRepository;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Service\ExternalProviderService;
use Monolog\Logger;
use Unirest;


class Walmart implements ConsumeRawData
{
    /** Example Data
     *
     * $response = Unirest\Request::get('http://api.walmartlabs.com/v1/items?format=json&apiKey=ep7npckux5mvje859n62btkz&upc=887276122915');
     * http://api.walmartlabs.com/v1/reviews/46708411?format=json&apiKey=ep7npckux5mvje859n62btkz
     */
    CONST NAME = "Walmart";
    CONST ITEMS_URL = "http://api.walmartlabs.com/v1/items?";
    CONST REVIEWS_URL = "http://api.walmartlabs.com/v1/reviews/";
    CONST FORMAT = "json";
    CONST HEADERS = ['Accept' => 'application/json'];

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function authenticate()
    {
        // Not needed for walmart
    }

    /** consume is where we make our api call to gather product data.
     *
     * https://developer.walmartlabs.com/docs
     * user: bowen9284 password: starredup1
     *
     * Pass the UPC, not the item ID when adding from the ExternalDataProviderController
     *
     * @param integer $itemIds
     * @return bool
     */
    public function consume($itemIds)
    {
        $itemIds = explode(',', $itemIds);
        $provider = $this->getProvider();
        $walmartItemIds = [];

        foreach ($itemIds as $itemId) {
            // first call to get item by UPC
            $upcData = ['format' => self::FORMAT, 'apiKey' => $provider->getProviderKey(), 'upc' => $itemId];
            $upcResponse = Unirest\Request::get(self::ITEMS_URL, self::HEADERS, $upcData);
            // now we have the Walmart product id's
            array_push($walmartItemIds, $upcResponse->body->items[0]->itemId);
        }
        $walmartItemIds = implode(',', $walmartItemIds);
        // get items by Walmart product id's (contains more data than by UPC)
        $itemData = ['format' => self::FORMAT, 'apiKey' => $provider->getProviderKey(), 'ids' => $walmartItemIds];
        $itemResponse = Unirest\Request::get(self::ITEMS_URL, self::HEADERS, $itemData);
        $items = (array)$itemResponse->body->items;
        if (!$rawProductData = $this->saveRawProductData(self::NAME, $items)) {
            return false;
        }

        $this->processProducts($rawProductData);

        return true;
    }

    /** saveRawData is where save our initial data raw
     * @param $providerName
     * @param array $data
     * @return array|bool
     */
    public function saveRawProductData($providerName, array $data)
    {
        $rawData = null;
        $repository = $this->em->getRepository(ExternalProvider::class);
        $provider = $repository->findOneByProviderName($providerName);
        if (!empty($provider)) {
            $extProId = $provider->getExternalProviderId();
            $rawData = $itemIds = $rawProducts = [];
            if (!empty($data)) {
                foreach ($data as $k => $d) {
                    $itemIds[] = $d->itemId;
                    $rd = new ExternalProviderProductRawData();
                    $rawProduct = $this->em->getRepository(ExternalProviderProductRawData::class)
                        ->findOneBy(['externalProviderId' => $extProId, 'upc' => $d->upc]);
                    if (!is_null($rawProduct)) {
                        $rawProduct->setExternalProviderData(json_encode($d));
                        $this->em->persist($rawProduct);
                        $rawData[$k] = $d;
                        $rawData[$k]->exists = true;
                    } else {
                        $rd->setExternalProviderId($extProId)
                            ->setExternalProviderData(json_encode($d))
                            ->setUpc($d->upc);
                        // tells Doctrine you want to (eventually) save the Product
                        $this->em->persist($rd);
                        $rawData[$k] = $d;
                    }
                    $rawProducts[] = $rawProduct ?: $rd;
                }

                $this->em->flush();
            }
        }

        return $rawData;
    }

    /**
     * processData is where an initial product comes into the database.
     * First we add the product to the product table
     *
     * @param $data
     * @return mixed
     */
    public function processProducts($data)
    {
        $products = [];
        foreach ($data as $d) {
            // if the item doesn't exist already, create a new one, else update
            if (!isset($d->exists)) {
                $product = new Product();
                $product->setProductName($d->name)
                    ->setProductDescription(json_encode($d->longDescription))
                    ->setProductRating($d->customerRating)
                    ->setReviewCount($d->numReviews)
                    ->setProductManufacturer($d->brandName)
                    ->setUpc($d->upc);
            } else {
                $product = $this->em->getRepository(Product::class)->findOneByUpc($d->upc);
                $product->setProductRating($d->customerRating)
                    ->setReviewCount($d->numReviews);
            }

            $products[] = $product;
            /** @todo listen and log these exceptions
             *  http://symfony.com/doc/current/event_dispatcher.html
             */
            try {
                $this->em->persist($product);
            } catch (ORMInvalidArgumentException $e) {
                echo $e->getMessage();
            } catch (UniqueConstraintViolationException $e) {
                echo $e->getMessage();
            } catch (ORMException $e) {
                echo $e->getMessage();
            }
        }

        $this->em->flush();
        $this->saveRawReviewData($products);

        return true;
    }

    public function saveRawReviewData(array $products)
    {
        if (empty($products)) {
            echo "product can't be empty.";
        }
        $rawIds = [];
        $rawReviewRepository = $this->em->getRepository(ExternalProviderReviewRawData::class);
        $rawProductRepository = $this->em->getRepository(ExternalProviderProductRawData::class);
        $provider = $this->getProvider();

        foreach ($products as $p) {
            $rawProduct = $rawProductRepository->findOneByUpc($p->getUpc());
            $providerData = json_decode($rawProduct->getExternalProviderData());
            if ($id = (string)$providerData->itemId) {
                $response = Unirest\Request::get(
                    "http://api.walmartlabs.com/v1/reviews/$id?format=json&apiKey={$provider->getProviderKey()}", 'json');
                $reviewResponse = (array)$response->body->reviews;
                if ($updateReview = $rawReviewRepository->findOneByExternalRawProductDataId($p->getProductId())) {
                    $updateReview->setExternalProviderData(json_encode($reviewResponse));
                    $this->em->persist($updateReview);
                    $this->em->flush();
                    $rawIds[] = $updateReview->getExternalReviewRawDataId();
                } else {
                    $rawReview = new ExternalProviderReviewRawData();
                    $rawReview->setExternalProductRawDataId($p->getProductId());
                    $rawReview->setExternalProviderData(json_encode($reviewResponse));
                    $rawReview->setUpc($p->getUpc());
                    $rawReview->setExternalProviderId($provider->getExternalProviderId());
                    $this->em->persist($rawReview);
                    $this->em->flush();
                    $rawIds[] = $rawReview->getExternalReviewRawDataId();
                }
            }
        }

        $this->processReviews($rawIds);

        return true;
    }

    public function processReviews(array $rawIds)
    {
        $rawReviewRepository = $this->em->getRepository(ExternalProviderReviewRawData::class);

        foreach ($rawIds as $id) {
            // retrieve the product id from this custom query
            $product = $rawReviewRepository->getProductFromReviewRawDataId($id);
            $productId = $product[0]->getProductId();
            $rawReview = $rawReviewRepository->findOneByExternalReviewRawDataId($id);
            $rawReviewProviderData = json_decode($rawReview->getExternalProviderData());

            foreach($rawReviewProviderData as $rd) {
                $review = new Review();
                $review->setProductId($productId);
                $review->setRating($rd->overallRating->rating);
                $review->setReviewTitle($rd->title);
                $review->setDescription($rd->reviewText);
                $review->setOriginalMemberName($rd->reviewer);
                $this->em->persist($review);
            }
        }

        try {
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
           echo $e->getMessage();
        }
    }

    public function getProvider()
    {
        $repository = $this->em->getRepository(ExternalProvider::class);
        $provider = $repository->findOneByProviderName(self::NAME);

        return $provider;
    }
}