<?php

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
                ->add('email', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["attr" => array("style" => "background-color:white")])
//                ->add('password', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ["label" => "Mot de passe", "attr" => array("style" => "background-color:white")])
//                ->add('dateNaissance', \Symfony\Component\Form\Extension\Core\Type\DateType::class, array("widget" => "single_text"))
                ->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array("label" => "S'inscrire", "attr" => array("class" => "btn btn-success")))
                ->getForm();
        $form->handleRequest($request);
        $nom = $unUser->getUserName();
        $user = $em->getRepository(User::class)->findByUserName(['user_name' => $nom]);

        if ($user == null) {
            if ($form->isSubmitted() && $form->isValid()) {
                $unUser->setIsActive(1);
                $unUser->setRole("ROLE_USER");

                $random = rand(0, 9);
                $crea = "1==1";
                for ($i = 0; $i < 5; $i++) {
                    $random = $random . rand(0, 9);
                }
                $unUser->setPassword($random);
                $em->persist($unUser);
                $em->flush();
                return $this->render("home/index.html.twig", array('mdp' => $random, "crea" => $crea));
//                return $this->redirectToRoute("home");
            }
        } else {
            
        }
        return $this->render("home/modifier.html.twig", array('form' => $form->createView()));
    }

}
