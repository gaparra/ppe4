<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

/**
 * 
 *
 * @author g.parra
 */
class Creation extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController {

    /**
     * @Route ("/Ajout",name="ajouter")
     */
    public function Ajouter(\Doctrine\ORM\EntityManagerInterface $em, Request $request) {
        $unUser = new User();
        $form = $this->createFormBuilder($unUser)
                ->add('user_name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "Identifiant", "attr" => array("style" => "background-color:white")])
                ->add('password', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "Mot de passe (6 chiffres)", "attr" => array("style" => "background-color:white")])
                ->add('email', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["attr" => array("style" => "background-color:white")])
//                ->add('dateNaissance', \Symfony\Component\Form\Extension\Core\Type\DateType::class, array("widget" => "single_text"))
                ->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array("label" => "S'inscrire", "attr" => array("class" => "btn btn-success")))
                ->getForm();
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $unUser->setIsActive(1);
            $unUser->setRole("ROLE_USER");

            $em->persist($unUser);
            $em->flush();

            $random = rand(0, 9);
            for ($i = 0; $i < 5; $i++) {
                $random = $random.rand(0, 9);
            }
            return $this->render("home/index.html.twig", array('mdp' => $random));

//            return $this->redirectToRoute("home");
        }
        return $this->render("home/modifier.html.twig", array('form' => $form->createView()));
    }

}
