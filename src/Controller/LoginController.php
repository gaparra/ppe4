<?php

namespace App\Controller;

use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Description of LoginController
 *
 * @author g.parra
 */
class LoginController extends AbstractController {

    /**
     * @Route("/login",name="login")
     */
    public function login(AuthenticationUtils $auth, EntityManagerInterface $em) {
        $codes = $em->getRepository(Test::class)->findAll();
        $erreur = $auth->getLastAuthenticationError();
        $lastUserName = $auth->getLastUsername();
        return $this->render('login/login.html.twig', array('last_username' => $lastUserName, 'error' => $erreur, 'codes' => $codes));
    }

}
