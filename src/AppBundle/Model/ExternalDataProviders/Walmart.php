<?php

namespace AppBundle\Model\ExternalDataProviders;

use AppBundle\AppBundle;
use AppBundle\Entity\ExternalProviderProcessedData;
use AppBundle\Entity\ExternalProviderRawData;
use AppBundle\Entity\ExternalProvider;
use AppBundle\Entity\Product;
use AppBundle\Model\ExternalDataProviders\ConsumeRawData;
use AppBundle\Repository\ExternalProviderRawDataRepository;
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
    CONST URL = "http://api.walmartlabs.com/v1/items?";
    CONST FORMAT = "json";

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function authenticate()
    {
        // Not needed for this method
    }

    /** consume is where we make our api call to gather product data.
     *
     * https://developer.walmartlabs.com/docs
     * user: bowen9284 password: starredup1
     *
     * @param integer $itemIds
     * @return bool
     */
    public function consume($itemIds)
    {
        $itemIds = explode(',', $itemIds);
        $repository = $this->em->getRepository('AppBundle:ExternalProvider');
        $provider = $repository->findOneByProviderName(self::NAME);

        // Request headers
        $headers = array('Accept' => 'application/json');

        $walmartItemIds = [];
        foreach($itemIds as $itemId) {
            // first call to get item by UPC
            $upcData = array('format' => self::FORMAT, 'apiKey' => $provider->getProviderKey(), 'upc' => $itemId);
            $upcResponse = Unirest\Request::get(self::URL, $headers, $upcData);

            array_push($walmartItemIds, $upcResponse->body->items[0]->itemId);
        }

        $walmartItemIds = implode(',', $walmartItemIds);
        $itemData = array('format' => self::FORMAT, 'apiKey' => $provider->getProviderKey(), 'ids' => $walmartItemIds);
        $itemResponse = Unirest\Request::get(self::URL, $headers, $itemData);
        $items = (array) $itemResponse->body->items;
        if (!$raw_data = $this->saveRawData(self::NAME, $items)) {
            return false;
        }
        $this->processData($raw_data);

        return true;
    }


    /** saveRawData is where save  our initial data
     * @param $providerName
     * @param array $data
     * @return array|bool
     */
    public function saveRawData($providerName, array $data)
    {
        $repository = $this->em->getRepository('AppBundle:ExternalProvider');
        $provider = $repository->findOneByProviderName($providerName);
        if (!empty($provider)) {
            $rawData = [];
            // save raw data
            $extProId = $provider->getExternalProviderId();
            $rd = new ExternalProviderRawData();
            $rd->setExternalProviderId($extProId);
            if (!empty($data)) {
                foreach ($data as $k => $d) {
                    $rd->setExternalProviderData(json_encode($d));
                    $rd->setUpc($d->upc);
                    // tells Doctrine you want to (eventually) save the Product (no queries yet)
                    $this->em->persist($rd);
                    $rawData[$k] = $d;
                }
            }
        } else {
            return false;
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
    public function processData($data)
    {
        $rdRepository = $this->em->getRepository('AppBundle:ExternalProviderRawData');
        foreach ($data as $d) {
            $rd = $rdRepository->findOneByUpc($d->upc);

            $product = new Product();
            $product->setProductName($d->name)
                ->setProductDescription($d->longDescription)
                ->setProductRating($d->customerRating)
                ->setReviewCount($d->numReviews)
                ->setProductManufacturer($d->brandName)
                ->setUpc($d->upc);

            /** @todo listen and log these exceptions
             *  http://symfony.com/doc/current/event_dispatcher.html
             */
            try {
                $this->em->persist($product);
                $this->em->flush();
            } catch (ORMInvalidArgumentException $e) {
                echo $e->getMessage();
            } catch (UniqueConstraintViolationException $e) {
                echo $e->getMessage();
            } catch (ORMException $e) {
                echo $e->getMessage();
            }
        }

        return $data;
    }


}