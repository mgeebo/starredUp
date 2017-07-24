<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use Swagger\Annotations as SWG;

/**
 * @SWG\Path(
 *   path="/products"
 * )
 */
class ProductController extends ApiController
{
    protected $em;

    public function __construct() {
    }

    /**
    * @SWG\Get(
    *     path="/products/{product_id}",
    *     @SWG\Response(response="200", description="Success")
    * )
    *
    * @Route("/products/{id}")
    * @Method({"GET"})
    */
    public function getProduct($id)
    {

        return new Response("Product");
    }



}