<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Controller used to manage the application security.
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in config/packages/security.yaml
     *
     * @Route("/logout", name="security_logout")
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('This should never be reached!');
    }
}
