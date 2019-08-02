<?php

namespace SoftUniBlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SoftUniBlogBundle\Service\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @Route("/admin/users", name="admin_users" , methods={"GET"})
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     7*/
    public function indexAction()
    {

        return $this->render('admin/users.html.twig',
            [
                'users' => $this->userService->getAll()
            ]
        );
    }
}
