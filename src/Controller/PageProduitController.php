<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of PageProduitController
 *
 * @author g.parra
 */
class PageProduitController extends AbstractController {

    /**
     * @Route("/pageproduit/{id}",name="pageproduit")
     */
    public function pageproduit($id, EntityManagerInterface $em) {
        $produit = $em->getRepository(Produits::class)->find($id);
        //getRepository(users::class) est l'equivalent de select * from users
        return $this->render("pageproduit/pageproduit.html.twig", array('produit' => $produit));
    }

}
