<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    *     tags={"products"},
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
    *       description="No product found for ID: {productId}"
    *     )
    *   )
    *
    * @Route("/products/{productId}")
    * @Method({"GET"})
    */
    public function getProduct($productId)
    {
        $em = $this->getDoctrine();

        try {
            $product = $em->getRepository(Product::class)->findByProductId($productId);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(["No product found for ID: $productId"], 404);
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
     *     tags={"products"},
     *     path="/products/add",
     *     summary="Save or Update a single product with a payload",
     *     description="Return JSON with the effected product ID",
     *     operationId="addProduct",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *       name="body",
     *       in="body",
     *       description="Update a product by adding the productId to the payload",
     *       required=true,
     *       @SWG\Schema(ref="#/definitions/Product")
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
                return new JsonResponse(["No product found for ID: $productId"], 404);
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

        return new JsonResponse([
            "success" => [
                "productId" => $product->getProductId()
            ]
        ]);
    }
    /**
     * @SWG\Post(
     *     tags={"products"},
     *     path="/products/{productId}/remove",
     *     summary="Deactivate a product",
     *     description="Return JSON object of the effected product and isActive status",
     *     operationId="removeProduct",
     *     consumes={"application/json"},
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
     *      @SWG\Response(response="404",
     *       description="No product found for ID: {productId}"
     *     ),
     *      @SWG\Response(response="409",
     *       description="Product has already been removed"
     *     )
     * )
     *
     * @Route("/products/{productId}/remove")
     * @Method({"POST"})
     */
    public function removeProduct($productId) {
        $em = $this->getDoctrine()->getManager();
        if (is_null($product = $em->getRepository(Product::class)->find($productId))) {
            return new JsonResponse(["No product found for ID: $productId"], 404);
        }

        if ($product->getIsActive() == false) {
            return new JsonResponse(["Product has already been removed"], 409);
        }

        $product->setIsActive(0);

        try {
            $em->persist($product);
            $em->flush();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new JsonResponse([
            "success" => [
                "productId" => $product->getProductId(),
                "isActive" => $product->getIsActive()
            ]
        ]);
    }



}