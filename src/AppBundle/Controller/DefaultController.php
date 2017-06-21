<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ExternalProviderRawData;
use Assetic\Filter\PackerFilter;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Review;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;
use AppBundle\Model\ExternalDataProviders\Walmart;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        return "Homepage";
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function createAction()
    {
        // or fetch the em via the container
        /** @var EntityManagerInterface $em */
        $em = $this->get('doctrine')->getManager();

        $review = new Review();
        $review->setName('Sweet Blender')
            ->setDescription('It blends')
            ->setRating(5.0);


        // tells Doctrine you want to (eventually) save the review (no queries yet)
        $em->persist($review);

        // actually executes the queries (i.e. the INSERT query)
        try {
            $em->flush();
        } catch (ORMException $e) {
            $e->getMessage();
        }

        return new Response('Saved new review with id '.$review->getId());
    }

}
