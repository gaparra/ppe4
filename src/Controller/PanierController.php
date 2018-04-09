<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Produits;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of LoginController
 *
 * @author g.parra
 */
class PanierController extends AbstractController {

    /**
     * @Route("/panier",name="panier")
     */
    public function panier(EntityManagerInterface $em) {
        $user = $this->getUser()->getUsername();
        $panier = $em->getRepository(Panier::class)->findBy(['id_user' => $user]);
        //getRepository(users::class) est l'equivalent de select * from users
        if ($panier == null) {
            $vide = "1==1";
            return $this->render('panier/panier.html.twig', ['panier' => $panier, 'vide' => $vide,]);
        }
        $vide = "";
        return $this->render('panier/panier.html.twig', ['panier' => $panier, 'vide' => $vide]);
    }

    /**
     * @Route("/plusun/{id}",name="plusun")
     */
    public function modifqtepanier($id, EntityManagerInterface $em) {
        $produit = $em->getRepository(Panier::class)->find($id);
        //getRepository(users::class) est l'equivalent de select * from users
        $stockac = $produit->getQuantite();
        $prix = $produit->getPrix();
        $idproduit = $produit->getNom_produit();

//        $user = $this->getUser()->getUsername();
        $prodboutique = $em->getRepository(Produits::class)->findOneBy([
            'id' => $idproduit,
        ]);
        $stockacboutique = $prodboutique->getStock();
        if ($stockacboutique > 0) {
            $stockmtn = $stockac + 1;
            $stockmtnboutique = $stockacboutique - 1;
            $prixprod = $prodboutique->getPrix();
            $prixpanier = $prix + $prixprod;

            $produit->setPrix($prixpanier);
            $produit->setQuantite($stockmtn);
            $prodboutique->setStock($stockmtnboutique);
            $em->persist($produit);
            $em->persist($prodboutique);
            $em->flush();
        }

//            return $this->render("boutique/css.html.twig", array('untoto' => $unToto));
        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/moinsun/{id}",name="moinsun")
     */
    public function modifqtepaniermoins($id, EntityManagerInterface $em) {
        $produit = $em->getRepository(Panier::class)->find($id);
        //getRepository(users::class) est l'equivalent de select * from users
        $stockac = $produit->getQuantite();
        $prix = $produit->getPrix();
        $idproduit = $produit->getNom_produit();

//        $user = $this->getUser()->getUsername();
        $prodboutique = $em->getRepository(Produits::class)->findOneBy([
            'id' => $idproduit,
        ]);
        $stockmtn = $stockac - 1;
        $stockacboutique = $prodboutique->getStock();
        $stockmtnboutique = $stockacboutique + 1;
        if ($stockac == 1) {
            $em->remove($produit);
            $em->flush();
            return $this->redirectToRoute("panier");
        }
        $prixprod = $prodboutique->getPrix();
        $prixpanier = $prix - $prixprod;

        $produit->setPrix($prixpanier);
        $produit->setQuantite($stockmtn);
        $prodboutique->setStock($stockmtnboutique);
        $em->persist($produit);
        $em->persist($prodboutique);
        $em->flush();
//            return $this->render("boutique/css.html.twig", array('untoto' => $unToto));
        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/delete/{id}",name="delete")
     */
    public function deletetuple($id, EntityManagerInterface $em) {
        $produit = $em->getRepository(Panier::class)->find($id);
        $nomprod = $produit->getNom_produit();
        $qteachete = $produit->getQuantite();
        $boutique = $em->getRepository(Produits::class)->find($nomprod);
        $stock = $boutique->getStock();
        $stock = $stock + $qteachete;
        $boutique->setStock($stock);
        $em->persist($boutique);
        $em->remove($produit);
        $em->flush();
//            return $this->render("boutique/css.html.twig", array('untoto' => $unToto));
        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/valid",name="valid")
     */
    public function valid(EntityManagerInterface $em) {
        $user = $this->getUser()->getUsername();
        $produits = $em->getRepository(Panier::class)->findBy(['id_user' => $user]);
        //getRepository(users::class) est l'equivalent de select * from users

        $numCom = "";
        for ($i = 0; $i < 7; $i++) {
            $j = rand(1, 3);
            if ($j == 1) {
                $numCom = $numCom . chr(rand(48, 57));
            }
            if ($j == 2) {
                $numCom = $numCom . chr(rand(65, 90));
            }
            if ($j == 3) {
                $numCom = $numCom . chr(rand(97, 122));
            }
        }
        if (isset($produits)) {

            foreach ($produits as $unProduit) {
                $commande = new Commande();
                $commande->setNum_commande($numCom);
                $commande->setId_produit($unProduit->getNom_Produit());
                $commande->setId_user($this->getUser());
                $commande->setDate((new DateTime('now')));
                $commande->setQuantite($unProduit->getQuantite());
                $commande->setEst_valid(0);
                $commande->setPrix($unProduit->getPrix());
                $em->persist($commande);
                $em->remove($unProduit);
            }
        }
        $em->flush();
        return $this->redirectToRoute("panier");
    }

}

//[
//                'var' => $var ,
//                ''
//                    ]);


//$em->remove($article); avec article comme objet à supprimer. 