<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductCart;
use App\Entity\User;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage the application security.
 */
class ProductController extends AbstractController
{
    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/create", name="product_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createProduct(Request $request)
    {
        $user = $this->getUser();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $product->setAuthor($user);
            $product->setQuantity(30);
            $product->setViewCount(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect("/");
        }

        return $this->render('product/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/product/{id}", name="product_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function viewProduct($id)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $product->setViewCount($product->getViewCount() + 1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->render('product/product.html.twig',
            ['product' => $product]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/myProducts", name="my_products")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function myProducts()
    {
        $products = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['authorId' => $this->getUser()]);

        return $this->render('user/myProducts.html.twig',
            ['products' => $products]);
    }


    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/product/add/{id}", name="add_to_cart")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addProduct($id)
    {
        $productBuy = new ProductCart();
        $userId = $this->getUser()->getId();
        $productId = $id;

        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

        $productsCart = $this->getDoctrine()->getRepository(ProductCart::class)->findAll();

        if ($user->isAuthor($product)) {
            return $this->redirectToRoute('product_view', ['id' => $id]);
        }

        for ($i = 0; $i < count($productsCart); $i++) {
            if ($productsCart[$i]->getProductId() == $id && $productsCart[$i]->getUserId() == $user->getId()) {
                $productsCart[$i]->setIsDeleted(false);

                $em = $this->getDoctrine()->getManager();
                $em->persist($productsCart[$i]);
                $em->flush();

                return $this->redirectToRoute("my_cart_products");
            }
        }

        $productBuy->setUser($user);
        $productBuy->setProduct($product);
        $productBuy->setIsDeleted(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($productBuy);
        $em->flush();

        return $this->redirectToRoute('my_cart_products');
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/cart/products", name="my_cart_products")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function myCartProducts()
    {
        $userId = $this->getUser()->getId();

        $cartProductsId = $this->getDoctrine()->getRepository(ProductCart::class)
            ->findBy(["userId" => $userId]);

        $cartProducts = [];

        $totalSum = 0;

        for ($i = 0; $i < count($cartProductsId); $i++) {
            if (!$cartProductsId[$i]->isDeleted()) {
                $totalSum += $cartProductsId[$i]->getProduct()->getPrice();
                $cartProducts[] = $cartProductsId[$i]->getProduct();
            }
        }


        return $this->render('user/myProduct.html.twig', ['products' => $cartProducts,
            'total' => $totalSum]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/myProduct/edit/{id}", name="product_edit")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function editProduct(Request $request, $id)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute("my_products");
        }

        return $this->render('product/edit.html.twig',
            ['product' => $product, "form" => $form->createView()]);
    }


    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/myProduct/delete/{id}", name="product_delete")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function deleteProduct(Request $request, $id)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();

            return $this->redirectToRoute("my_products");
        }

        return $this->render('product/delete.html.twig',
            ['product' => $product, "form" => $form->createView()]);
    }


    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/user/myProduct/remove/{id}", name="product_cart_remove")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function removeProductFromCart(Request $request, $id)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $user = $this->getUser();

        $productBuy = $this
            ->getDoctrine()
            ->getRepository(ProductCart::class)
            ->findOneBy(['product' => $product, 'user' => $user]);

        $productBuy->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($productBuy);
        $em->flush();

        return $this->redirectToRoute('my_cart_products');

    }

    /**
     * @Route("/user/myProduct/buy/{id}", name="product_cart_buy")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function buyProductFromCart($id)
    {
        $order = new Order();

        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $user = $this->getUser();

        $productCart = $this
            ->getDoctrine()
            ->getRepository(ProductCart::class)
            ->findOneBy(['product' => $product, 'user' => $user]);

        $order->setProduct($product);
        $order->setUser($user);

        $productCart->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->persist($productCart);
        $em->flush();

        return $this->redirectToRoute('my_cart_products');
    }


    /**
     * @Route("/user/myProduct/buyAll", name="all_product_cart_buy")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function buyAllProductFromCart()
    {
        $user = $this->getUser();

        $productCart = $this
            ->getDoctrine()
            ->getRepository(ProductCart::class)
            ->findBy(['user' => $user, 'isDeleted' => false]);

        $em = $this->getDoctrine()->getManager();

        foreach($productCart as $product){
            $order = new Order();

            $order->setProduct($product->getProduct());
            $order->setUser($user);
            $product->setIsDeleted(true);

            $em->persist($product);
            $em->persist($order);
        }

        $em->flush();

        return $this->redirectToRoute('my_cart_products');
    }


}
