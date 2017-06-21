<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Model\ExternalDataProviders\Walmart;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ExternalProviderRawData;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;


class ExternalDataProviderController extends Controller
{

    /**
     * @Route("/add/product")
     * @Method({"POST"})
     */
    public function postProducts(Request $request)
    {
        $productIds = $request->request->get('productId');

        $em = $this->get('doctrine')->getEntityManager();
        $walmart = new Walmart($em);
        $success = $walmart->consume($productIds);

        return new Response((string)$success);
    }
}