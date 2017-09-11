<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionController extends Controller
{
    /**
     * @Route ("/session", name="session")
     */

        public function indexAction(Request $request)
        {
            $session = new Session();

            //Set and get session attributes
            $session->set('name','StarredUp');
            $user = $session->get('name');

            return $this->render('session/index.html.twig', ['user' => $user]);
        }

    /**
     * @Route ("/admin", name="admin")
     */

        public function adminAction(Request $request)
        {
            $session = new Session();
            $this->get('session')->getFlashBag()->add('message', 'Does Not Exist');

            $session->set('name', "Griffin");
            return $this->render('session/admin.html.twig');
        }
}