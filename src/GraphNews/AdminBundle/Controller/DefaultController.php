<?php

namespace GraphNews\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GraphNewsAdminBundle:Default:index.html.twig', array('name' => 'jip'));
    }
}
