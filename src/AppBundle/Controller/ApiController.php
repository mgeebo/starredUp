<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ApiController
 *
 * @package AppBundle\Controller
 *
 * @SWG\Swagger(
 *     host="localhost:8000",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="StarredUp API",
 *     )
 * )
 */
class ApiController extends Controller
{
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