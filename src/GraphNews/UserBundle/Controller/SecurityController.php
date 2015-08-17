<?php

namespace GraphNews\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
Use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('GraphNewsUserBundle:Security:login.html.twig', array(
          // Valeur du précédent nom d'utilisateur entré par l'internaute
          'last_username' => $lastUsername,
          'error'         => $error,
        ));
    }
}
