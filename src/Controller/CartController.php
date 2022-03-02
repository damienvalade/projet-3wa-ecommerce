<?php

namespace App\Controller;

use App\Entity\Buyer;
use App\Entity\Cart;
use App\Entity\Article;
use App\Entity\CartArticle;
use App\Repository\CartArticleRepository;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'show_cart')]
    public function index(CartRepository $cartRepository, EntityManagerInterface $manager): Response
    {
        $cart = $this->findCart($cartRepository, $manager);


        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cart,
        ]);
    }


    #[Route('/cart/add/{id}', name: 'add_cart')]
    public function addArticle(
        Article $article,
        CartRepository $cartRepository,
        EntityManagerInterface $manager,
        CartArticleRepository $cartArticleRepository): JsonResponse
    {

        $cart = $this->findCart($cartRepository, $manager);

        $cartArticle = $cartArticleRepository->findArticleForCart($article,$cart);

        if (!$cartArticle){
            $cartArticle = CartArticle::wadCreated($article, $cart);

            $cart->addCartArticle($cartArticle);


        } else {
            $cartArticle->setQuantity($cartArticle->getQuantity()+1);
        }
        $manager->persist($cartArticle);
        $manager->flush();
        return new JsonResponse("L'article a été rajouter au panier");
    }

    protected function findCart(CartRepository $cartRepository, EntityManagerInterface $manager): Cart
    {
        /** @var Buyer $user */
        $user = $this->getUser();
        $cart = $cartRepository->findUserCart($user);
        if (!$cart) {
            $cart = $this->newCart($user);
            $manager->persist($cart);
            $manager->flush();
        }
        return $cart;
    }

    protected function newCart( Buyer $user): Cart
    {
        $cart = new Cart();
        $cart->setBuyer($user);

        return $cart;
    }
}
