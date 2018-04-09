<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of CommandeController
 *
 * @author g.parra
 */
class CommandeController extends AbstractController {

    /**
     * @Route("/commande",name="commande")
     */
    public function commande(EntityManagerInterface $em) {
        $user = $this->getUser()->getUsername();
        $commandes = $em->getRepository(Commande::class)->findBy(['id_user' => $user]);
        //getRepository(users::class) est l'equivalent de select * from users
        if ($commandes == null) {
            $vide = "1==1";
            return $this->render('commandes/commandes.html.twig', ['commandes' => $commandes, 'vide' => $vide,]);
        }
        $vide = "";
        return $this->render('commandes/commandes.html.twig', ['commandes' => $commandes, 'vide' => $vide]);
    }

}

//$article->setDate(new \DateTime('now'));

//[
//                'var' => $var ,
//                ''
//                    ]);


//$em->remove($article); avec article comme objet à supprimer. 