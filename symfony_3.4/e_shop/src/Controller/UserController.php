<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller used to manage the application security.
 */
class UserController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $roleRepository = $this->getDoctrine()->getRepository(Role::class);
            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);

            $user->addRole($userRole);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'user/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/profile", name="user_profile")
     * @param AuthorizationCheckerInterface $authChecker
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $user = $this->getUser();

        $userOrders = $this
            ->getDoctrine()
            ->getRepository(Order::class)
            ->findBy(['user' => $user]);

        $totalMoney = 0;

        foreach ($userOrders as $order) {
            $totalMoney += $order->getProduct()->getPrice();
        }

        $user = $this->getUser();
        return $this->render("user/profile.html.twig", ['user' => $user, 'orders' => $userOrders,
            'total' => $totalMoney]);
    }
}
