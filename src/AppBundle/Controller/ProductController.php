<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Swagger\Annotations as SWG;

/**
 * @SWG\Path(
 *   path="/products"
 * )
 */
class ProductController extends ApiController
{
    /**
    * @SWG\Get(
    *     tags={"product"},
    *     path="/products/{productId}",
    *     summary="Get a single product by ID",
    *     description="Return JSON object of a single product",
    *     operationId="getProduct",
    *     produces={"application/json"},
    *     @SWG\Parameter(
    *       name="productId",
    *       in="path",
    *       description="Product ID of the desired product",
    *       required=true,
    *       type="integer"
    *     ),
    *     @SWG\Response(response="200",
    *       description="Success => [product => {product}]"
    *     ),
    *     @SWG\Response(response="404",
    *       description="No product found"
    *     )
    *   )
    *
    * @Route("/products/{id}")
    * @Method({"GET"})
    */
    public function getProduct($id)
    {
        $em = $this->getDoctrine();

        try {
            $product = $em->getRepository(Product::class)->findByProductId($id);
        } catch (InvalidArgumentException $e) {
            throw $this->createNotFoundException('No product found.');
        }

        if (!empty($product)) {
            $success = [
                "success" => [
                    "product" => $product[0]
                ]
            ];
            // Serialize array to make it returnable as a string for the Response
            $product = $this->serializer->serialize($success, 'json');
        }

        return new Response($product);
    }

    /**
     * @SWG\Post(
     *     tags={"product"},
     *     path="/products/add",
     *     summary="Save or Update a single product with a payload",
     *     description="Return JSON with the effected product ID",
     *     operationId="addProduct",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="productId",
     *       in="body",
     *       description="The product ID, only needed if updating",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="productName",
     *       in="body",
     *       description="The product name",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="productDescription",
     *       in="body",
     *       description="A short or long description of the product",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="productManufacturer",
     *       in="body",
     *       description="The manufacurer of the product",
     *       required=false,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="upc",
     *       in="body",
     *       description="The product UPC",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="isActive",
     *       in="body",
     *       description="If the product is active, only needed if updating an inactive product",
     *       required=false,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *       description="Success => [productId => {productId}]"
     *     ),
     *     @SWG\Response(response="404",
     *       description="No product found for id {productId}"
     *     )
     *   )
     *
     * @Route("/products/add")
     * @Method({"POST"})
     */
    public function addProduct(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $prop = $r->request->all();

        if (!is_null($productId = $prop['productId'])) {
            $product = $em->getRepository(Product::class)->find($productId);
            if (!$product) {
                throw $this->createNotFoundException('No product found for id '.$productId);
            }
        }

        $product->setProductName($prop['productName'])
            ->setProductDescription(json_encode($prop['productDescription']))
            ->setProductManufacturer($prop['productManufacturer'])
            ->setUpc($prop['upc'])
            ->setIsActive($prop['isActive']);

        try {
            $em->persist($product);
            $em->flush();
        } catch (ORMInvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (UniqueConstraintViolationException $e) {
            echo $e->getMessage();
        } catch (DriverException $e) {
            echo $e->getMessage();
        } catch (ORMException $e) {
            echo $e->getMessage();
        }

        return new Response(json_encode([
            "success" => [
                "productId" => $product->getProductId()
            ]
        ]));
    }
    /**
     * @SWG\Post(
     *     tags={"product"},
     *     path="/products/{product_id}/remove",
     *     summary="Deactivate a product",
     *     description="Return JSON object of the effected product and isActive status",
     *     operationId="removeProduct",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="productId",
     *       in="path",
     *       description="The product ID of the product to be deactivated",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Response(response="200",
     *      description="Success => [productId => {productId}, isActive => {isActive}]"
     *     ),
     *      @SWG\Response(response="400",
     *       description="Product has already been removed"
     *     )
     * )
     *
     * @Route("/products/{id}/remove")
     * @Method({"POST"})
     */
    public function removeProduct($id) {
        $em = $this->getDoctrine()->getManager();
        if (is_null($product = $em->getRepository(Product::class)->find($id))) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        if ($product->getIsActive() == false) {
            Return new \HttpException("Product has already been removed", 400);
        }

        $product->setIsActive(0);

        try {
            $em->persist($product);
            $em->flush();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return new Response(json_encode([
            "success" => [
                "productId" => $product->getProductId(),
                "isActive" => $product->getIsActive()
            ]
        ]));
    }



}