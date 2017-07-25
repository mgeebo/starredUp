<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    *     path="/products/{product_id}",
    *     @SWG\Response(response="200", description="Success")
    * )
    *
    * @Route("/products/{id}")
    * @Method({"GET"})
    */
    public function getProduct($id)
    {
        $this->em = $this->container->get('doctrine');
        $products = $this->em->getRepository('AppBundle:Product');
        $result = $products->find($id);

        $encoders = [new JsonEncoder()];
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($result, 'json');
        return new JsonResponse($jsonContent);
    }



}