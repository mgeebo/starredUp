<?php
/**
 * Created by PhpStorm.
 * User: HMGriffinIV
 * Date: 7/17/17
 * Time: 9:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
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
 *   path="/users"
 * )
 */

class UserController extends ApiController
{
    protected $em;

    public function __construct() {
    }

    /**
     * @SWG\Get(
     *     path="/users/{user_id}",
     *     @SWG\Response(response="200", description="Success")
     * )
     *
     * @Route("/users/{id}")
     * @Method({"GET"})
     */
    public function getUser($id)
    {

        return new Response("User");
    }

}