<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/Default/index.html.twig'); // , moze da ima i drugi argument ... array(), ne mora
        
        // return $this->render('default/index.html.twig'); // vraca difoltnu poce
    }
    
    /**
     * @Route("/user", name="user")
     */
     public function userAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/Default/user.html.twig'); // , moze da ima i drugi argument ... array(), ne mora
        
        // return $this->render('default/index.html.twig'); // vraca difoltnu poce
    }
}
