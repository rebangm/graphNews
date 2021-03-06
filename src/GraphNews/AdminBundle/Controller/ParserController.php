<?php

namespace GraphNews\AdminBundle\Controller;

use GraphNews\AdminBundle\Entity\Parser;
use GraphNews\AdminBundle\Form\ParserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ParserController extends Controller
{

    private $limitOptions = array(5,10,50);

    private $authorizedColumns = array('id','name');


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
            return $this->redirect($this->generateUrl('graph_news_admin_parserlist', array( 'page' => 1 )));
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
        $dql   = "SELECT a FROM GraphNewsAdminBundle:Parser a ORDER BY a." . $order . " ASC";

        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $limit
        );

        $pagination->setTemplate('GraphNewsPaginatorBundle::slidingPagination.html.twig');
        $pagination->setUsedRoute('graph_news_admin_parserlistpage');

        return $this->render('GraphNewsAdminBundle:Parser:list.html.twig',
            array( 'limitOptions' => $this->limitOptions,
                'pagination' => $pagination
            ));
    }



    public function addAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN') ) {
            $request = $this->get('request');
            $session = $request->getSession();
            $jsonUtils = $this->get('gf_admin.jsonutils');
            $defaultParserFilename = '@GraphNewsAdminBundle/Resources/config/parser.example.json';

            $kernel = $this->container->get('kernel');
            try {
                $path = $kernel->locateResource($defaultParserFilename);
                $defaultParserConf = $jsonUtils->jsonPretty(file_get_contents($path));
            }catch(\Exception $e){
                $session->getFlashBag()->add('warning', 'Erreur de chargement de la valeur par défaut!');
            }

            $parser = new Parser();

            $form = $this->createForm(new ParserType(), $parser);
            if ( $request->getMethod() == 'POST' ) {
                $form->handleRequest($request);
                if ( $form->isValid() ) {

                    $parser->setFormat($jsonUtils->jsonUglify($parser->getFormat()));
                    $em   = $this->getDoctrine()->getManager();
                    $em->persist($parser);
                    $em->flush();
                    $session->getFlashBag()->add('success', 'Site ajouté avec succès!');
                    return $this->redirect($this->generateUrl('graph_news_admin_parserlist'));
                } else {
                    $session->getFlashBag()->add('error',
                        'Données du formulaire invalide. ');
                }
            }

            return $this->render('GraphNewsAdminBundle:Parser:add.html.twig',
                array( 'form' => $form->createView(), 'defaultParserConf' => $defaultParserConf ));
        }
    }



    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN') ) {
            $jsonUtils = $this->get('gf_admin.jsonutils');
            $request = $this->get('request');
            $session = $request->getSession();

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('GraphNewsAdminBundle:Parser');

            $parser = $repository->findOneById($id);


            if ( $request->getMethod() == 'GET' ) {
                $parser->setFormat($jsonUtils->jsonPretty($parser->getFormat()));
            }
            $form = $this->createForm(new ParserType(), $parser);
            if ( $request->getMethod() == 'POST' ) {
                $form->handleRequest($request);
                if ( $form->isValid() ) {
                    $parser->setFormat($jsonUtils->jsonUglify($parser->getFormat()));
                    $em   = $this->getDoctrine()->getManager();
                    $em->persist($parser);
                    $em->flush();
                    $session->getFlashBag()->add('success',
                        'Modification effectuée!');
                    return $this->redirect($this->generateUrl('graph_news_admin_parserlist'));
                } else {
                    $session->getFlashBag()->add('error',
                        'Données du formulaire invalide.');
                }
            }

            return $this->render('GraphNewsAdminBundle:Parser:edit.html.twig',
                array( 'form' => $form->createView(), 'id'   => $id ));
        }
    }
}
