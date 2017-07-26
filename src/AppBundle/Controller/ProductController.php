<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * @SWG\Path(
 *   path="/products"
 * )
 */
class ProductController extends ApiController
{
    /**
    * @SWG\Get(
    *     path="/products/{productId}",
    *     summary="Get a single product",
    *     @SWG\Parameter(
    *       name="productId",
    *       in="path",
    *       description="Get a product from a product id",
    *       required=true,
    *       type="integer"
    *     ),
    *     @SWG\Response(response="200",
    *       description="Product JSON array",
    *     ),
    *     @SWG\Response(
    *       response="default",
    *       description="unexpected error",
    *     )
    *   )
    * @Route("/products/{id}")
    * @Method({"GET"})
    */
    public function getProduct($id)
    {
        $em = $this->getDoctrine();
        $product = $em->getRepository('AppBundle:Product')
            ->findByProductId($id);

        $jsonContent = $this->serializer->serialize($product[0], 'json');
        return new Response(htmlentities($jsonContent));
    }

    /**
     * @SWG\Post(
     *     path="/products/{product_id}",
     *     @SWG\Response(response="200", description="Success")
     * )
     *
     * @Route("/products/{id}")
     * @Method({"POST"})
     */
    public function addProduct() {

    }
    /**
     * @SWG\Post(
     *     path="/products/{product_id}/remove",
     *     @SWG\Response(response="200", description="Success")
     * )
     *
     * @Route("/products/{id}/remove")
     * @Method({"POST"})
     */
    public function removeProduct() {

    }



}