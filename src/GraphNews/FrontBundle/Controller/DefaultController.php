<?php

namespace GraphNews\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GraphNewsFrontBundle:Default:index.html.twig');
    }
}
