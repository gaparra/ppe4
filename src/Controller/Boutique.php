<?php

namespace App\Controller;   // -> comme un require_once

use App\Entity\Categorie;
use App\Entity\Panier;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//faire double click + fix uses pour mettre les use automatiquement

/**
 * Description of Test
 *
 * @author g.parra
 */
class Boutique extends AbstractController {

    /**
     * @Route("/boutique/{categ}",defaults={"categ"=null},name="boutique")
     */
    public function apiTotoMethodeClassique($categ, EntityManagerInterface $em) {
        if ($categ) {
            $unToto = $em->getRepository(Produits::class)->findByNomCategorie($categ);
        } else {
            $unToto = $em->getRepository(Produits::class)->findAll();
        }
        $lesCategs = $em->getRepository(Categorie::class)->findAll();
        //getRepository(users::class) est l'equivalent de select * from users

        return $this->render("boutique/css.html.twig", array('untoto' => $unToto, 'lescategs' => $lesCategs));
        //$unToto[0] -> pour recup juste le premier objet
        //$unToto -> pour recup le tableau de tout les toto et dans le twig faut faire un for
    }

    /**
     * @Route("/ajoutpanier/{id}",name="ajoutpanier")
     */
    public function modifStock($id, EntityManagerInterface $em) {
        $stockproduit = $em->getRepository(Produits::class)->find($id);
        //getRepository(users::class) est l'equivalent de select * from users
        $stockac = $stockproduit->getStock();
        $prix = $stockproduit->getPrix();
        if ($stockac > 0) {
            $user = $this->getUser()->getUsername();
            $panier = $em->getRepository(Panier::class)->findOneBy([
                'nom_produit' => $id,
                'id_user' => $user
            ]);
            if ($panier != null) {
                $qteac = $panier->getQuantite();
                $qtemtn = $qteac + 1;
                $panier->setQuantite($qtemtn);
                $totalprix = $panier->getPrix();
                $totalprix2 = $totalprix + $prix;
                $panier->setPrix($totalprix2);
            } else {
                $panier = new Panier();
                $panier->setQuantite(1);
                $panier->setNom_produit($stockproduit);
                $panier->setPrix($prix);
                $panier->setId_user($this->getUser());
            }
            $stockmtn = $stockac - 1;
            $stockproduit->setStock($stockmtn);
            $em->persist($stockproduit);
            $em->persist($panier);
            $em->flush();
            return $this->redirectToRoute("boutique");
//            return $this->render("boutique/css.html.twig", array('untoto' => $unToto));
        } else {
            return $this->redirectToRoute("boutique");
        }
    }

    //$unToto[0] -> pour recup juste le premier objet
    //$unToto -> pour recup le tableau de tout les toto et dans le twig faut faire un for

    /**
     * @Route("/filtrecateg/{categ}",name="filtrecateg")
     */
    public function filtrecateg($categ, EntityManagerInterface $em) {
        $produits = $em->getRepository(Produits::class)->findByNomCategorie($categ);

        return $this->render("boutique/css.html.twig", array('produits' => $produits));
    }

}
