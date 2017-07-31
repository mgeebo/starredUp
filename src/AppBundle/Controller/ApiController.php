<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiController
 *
 * @package AppBundle\Controller
 *
 * @SWG\Swagger(
 *     host="127.0.0.1:8000",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="StarredUp API",
 *     )
 * )
 */
class ApiController extends Controller
{
    protected $encoder;
    protected $normalizer;
    protected $serializer;

    public function __construct()
    {
        $this->encoder = [new JsonEncoder()];
        $this->normalizer = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizer, $this->encoder);
    }

    /**
     * @SWG\Get(
     *     path="/swagger",
     *     @SWG\Response(response="200", description="Success")
     * )
     *
     * @Route("/swagger")
     * @Method({"GET"})
     */
    public function getSwaggerDoc() {
        return $this->render("swagger-ui/index.html.twig");
    }

}