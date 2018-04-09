<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of LogoutController
 *
 * @author g.parra
 */
class LogoutController extends AbstractController {

    /**
     * @Route("/logout",name="logout")
     */
    public function logout() {
        return $this->redirectToRoute("home");
    }

}
