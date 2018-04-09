<?php

namespace App\Controller;

use App\Entity\UserAPI;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function dump;

/**
 * Description of API
 *
 * @author g.parra
 */
class API extends AbstractController {

    /**
     * @Route("/totosclassique/{id}",name="un_toto_cla")
     */
    public function apiTotoMethodeClassique($id, EntityManagerInterface $em) {
        $unToto = $em->getRepository(UserAPI::class)->findById($id);
        //getRepository(users::class) est l'equivalent de select * from users
        //User::class fait appel a la classe User où il y a appel a la bdd
        //appel au service de sérialisation
        //l'objet $unToto sera transformé en json
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($unToto[0], 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('ok', 'oui');
        return $response;
    }

    /**
     * @Route("/totostab",name="tab_toto")
     */
    public function apiTotoTableau(EntityManagerInterface $em) {
        $unToto = $em->getRepository(UserAPI::class)->findAll();
        //getRepository(users::class) est l'equivalent de select * from users
        //User::class fait appel a la classe User où il y a appel a la bdd
        //appel au service de sérialisation
        //l'objet $unToto sera transformé en json
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($unToto, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('ok', 'oui');
        return $response;
    }

    /**
     * @Route("/totosautomatique/{id}",name="un_toto_autom")
     */
    public function apiTotoMethodeAutomatique(UserAPI $unToto = null) {
        if ($unToto === null) {
            $response = new Response($unToto);
            $response->header->set('Ok', 'non');
            $response->setStatusCode(404);
            return $response;
        }
        //appel au service de sérialization
        // l'objet $unToto sera transformé en json  
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($unToto, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('ok', 'oui');
        return $response;
    }

    /**
     * @Route("/ajouttoto/",name="ajout_toto", methods="post")
     */
    public function ajoutToto(Request $request, EntityManagerInterface $em) {

        $serializer = $this->get("serializer");
        $unToto = $serializer->deserialize($request->getContent(), UserAPI::class, 'json');

        $em->persist($unToto);
        $em->flush();

        $response = new Response("L'ajout est réalisé ! ");
        $response->headers->set('Content-Type', 'application/text');
        $response->headers->set('Ok', 'oui');
        return $response;
//        $lesdonnees = json_decode($request->getContent());
//        dump($lesdonnees);
//        die;
    }

}
