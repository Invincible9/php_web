<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage the application security.
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em
            ->getRepository('App:Product')
            ->createQueryBuilder('e')
            ->addOrderBy('e.dateAdded', 'DESC')
            ->getQuery()
            ->execute();

        return $this->render('blog/index.html.twig', ["products" => $products]);
    }
}
