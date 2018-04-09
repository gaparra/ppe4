<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of HomeController
 *
 * @author g.parra
 */
class HomeController extends AbstractController {

    //put your code here
    /**
     * @Route("/",name="home")
     * @return Response
     */
    public function indexController() {
        //return new Response("Exemple d'exploitation de la sécurité");
        // ou on crée "rend" une vue twig
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/visiteur",name="visiteur")
     * @return Response
     */
    public function visiteurController() {
        return $this->render('visiteur/visiteur.html.twig');
    }

    /**
     * @Route("/perso",name="perso")
     * @return Response
     */
    public function persoController() {
        return $this->render('perso/perso.html.twig');
    }

}
