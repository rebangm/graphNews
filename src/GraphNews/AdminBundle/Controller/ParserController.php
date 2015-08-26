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

            $website = new Parser();

            $form = $this->createForm(new ParserType(), $website);
            if ( $request->getMethod() == 'POST' ) {
                $form->handleRequest($request);
                if ( $form->isValid() ) {

                    $em   = $this->getDoctrine()->getManager();
                    $em->persist($website);
                    $em->flush();
                    $session->getFlashBag()->add('success', 'Site ajouté avec succès!');
                    return $this->redirect($this->generateUrl('graph_news_admin_sitelist'));
                } else {
                    $session->getFlashBag()->add('error',
                        'Données du formulaire invalide. ');
                }
            }

            return $this->render('GraphNewsAdminBundle:Parser:add.html.twig',
                array( 'form' => $form->createView() ));
        }
    }



    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN') ) {
            $request = $this->get('request');
            $session = $request->getSession();

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('GraphNewsAdminBundle:Parser');

            $parser = $repository->findOneById($id);


            if ( $request->getMethod() == 'GET' ) {
                $parser->setFormat($this->jsonPretty($parser->getFormat()));
            }
            $form = $this->createForm(new ParserType(), $parser);
            if ( $request->getMethod() == 'POST' ) {
                $form->handleRequest($request);
                if ( $form->isValid() ) {
                    $parser->setFormat($this->jsonUglify($parser->getFormat()));
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

    /**
     * @param $json
     * @param string $istr
     * @return string
     * TODO create separate service for reuse
     */
    protected function jsonPretty($json, $istr='  ')
    {
        $result = '';
        for($p=$q=$i=0; isset($json[$p]); $p++)
        {
            $json[$p] == '"' && ($p>0?$json[$p-1]:'') != '\\' && $q=!$q;
            if(!$q && strchr(" \t\n\r", $json[$p])){continue;}
            if(strchr('}]', $json[$p]) && !$q && $i--)
            {
                strchr('{[', $json[$p-1]) || $result .= "\n".str_repeat($istr, $i);
            }
            $result .= $json[$p];
            if(strchr(',{[', $json[$p]) && !$q)
            {
                $i += strchr('{[', $json[$p])===FALSE?0:1;
                strchr('}]', $json[$p+1]) || $result .= "\n".str_repeat($istr, $i);
            }
        }
        return $result;
    }

    /**
     * @param $json
     * @return mixed
     * TODO create separate service for reuse
     */
    protected function jsonUglify($json)
    {
        return preg_replace('#\s(?=([^"]*"[^"]*")*[^"]*$)#',"",$json);
    }
}
