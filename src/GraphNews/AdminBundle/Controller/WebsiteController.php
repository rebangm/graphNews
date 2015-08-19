<?php

namespace GraphNews\AdminBundle\Controller;

use GraphNews\AdminBundle\Entity\Website;
use GraphNews\AdminBundle\Form\WebsiteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class WebsiteController extends Controller
{

    private $limitOptions = array(1,5,10,50);

    private $authorizedColumns = array('id','name','url');


    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function listAction($page)
    {
        $defaultLimit = 10;
        if ( $page < 1 ) {
            $error = "the page requested doesn't exist";
            $this->get('session')->getFlashBag()->add('error', $error);
            return $this->redirect($this->generateUrl('graph_news_admin_sitelist', array( 'page' => 1 )));
        }

        $limit  = (int)$this->container->get('request')->get('limit',$defaultLimit);
        if(!in_array($limit,$this->limitOptions))
            $limit = $defaultLimit;


        $order  = $this->container->get('request')->get('order', 'id');
        if(!in_array($order,$this->authorizedColumns)) {
            $order = 'id';
            $this->get('session')->getFlashBag()->add('error', "sort field not authorized");
        }

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM GraphNewsAdminBundle:Website a ORDER BY a." . $order . " ASC";

        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $limit
        );

        $pagination->setTemplate('GraphNewsPaginatorBundle::slidingPagination.html.twig');
        $pagination->setUsedRoute('graph_news_admin_sitelistpage');


        return $this->render('GraphNewsAdminBundle:Website:list.html.twig',
            array( 'limitOptions' => $this->limitOptions,
                'pagination' => $pagination
            ));

    }

    /**
     * @param $id
     * @param $active
     * @return JsonResponse
     *
     */
    public function setActiveAction($id, $active)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN') ) {
            if ($this->container->get('request')->isXmlHttpRequest()) {
                $em   = $this->getDoctrine()->getManager();
                $website = $em->getRepository('GraphNewsAdminBundle:Website')->find($id);


                if ( !$website ) {
                    $status  = 'error';
                    $message = 'Aucun utilisateur trouvé pour cet id : ' . $id;
                } else {
                    $website->setIsActive($active);
                    $em->flush();
                    $status  = 'success';
                    $message = array(
                        'id'     => $id,
                        'active' => $active,
                        'url'    => $this->generateUrl('graph_news_admin_ajax_active',
                            array( 'id'     => $id, 'active' => ( int ) !$active )) );
                }
            } else {
                $status  = 'error';
                $message = 'Not an ajax request.';
            }
        } else {
            $status  = 'error';
            $message = 'Unauthorized action for your role.';
        }
        return new JsonResponse(array( 'status'  => $status, 'message' => $message ));
    }


    public function addAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN') ) {
            $request = $this->get('request');
            $session = $request->getSession();

            $website = new Website();

            $form = $this->createForm(new WebsiteType(), $website);
            if ( $request->getMethod() == 'POST' ) {
                $form->handleRequest($request);
                if ( $form->isValid() ) {

                    $em   = $this->getDoctrine()->getManager();
                    $em->persist($website);
                    $em->flush();
                    $session->getFlashBag()->add('success', 'Site ajouté avec succès!');
                    return $this->redirect($this->generateUrl('graphnews_user_manage'));
                } else {
                    $session->getFlashBag()->add('error',
                        'Données du formulaire invalide. ');
                }
            }

            return $this->render('GraphNewsAdminBundle:Website:add.html.twig',
                array( 'form' => $form->createView() ));
        }
    }

}
