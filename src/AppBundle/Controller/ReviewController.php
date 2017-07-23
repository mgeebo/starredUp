<?php

namespace AppBundle\Controller;

use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;

/**
 * @SWG\Path(
 *   path="/reviews"
 * )
 */
class ReviewController extends ApiController
{
    /**
     * @SWG\Get(
     *     path="/reviews/{review_id}",
     *     @SWG\Response(response="200", description="Success")
     * )
     *
     * @Route("/reviews/{id}")
     * @Method({"GET"})
     */
    public function getProduct($id)
    {

        return new Response("Product");
    }
}