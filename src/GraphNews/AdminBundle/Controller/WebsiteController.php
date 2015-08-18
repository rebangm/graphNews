<?php

namespace GraphNews\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{
    public function listAction()
    {
        return $this->render('GraphNewsAdminBundle:Website:list.html.twig', array(

            ));    }

    public function addAction()
    {
        return $this->render('GraphNewsAdminBundle:Website:add.html.twig', array(
            ));    }

}
