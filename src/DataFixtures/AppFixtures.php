<?php

namespace App\DataFixtures;

use App\DBAL\Types\PaymentType;
use App\Entity\Article;
use App\Entity\Buyer;
use App\Entity\Cart;
use App\Entity\CartArticle;
use App\Entity\Category;
use App\Entity\CollectionPoint;
use App\Entity\Company;
use App\Entity\Feedback;
use App\Entity\Note;
use App\Entity\Order;
use App\Entity\OrderArticle;
use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $companies = [];
        $categories = [];
        $vendors = [];
        $buyers = [];
        $articles = [];
        $orders = [];
        $collectionPoints = [];
        $carts = [];

        for ($i = 0; $i <= 2; $i++) {
            //COMPAGNY
            $company = new Company();

            $company->setName($faker->company());
            $company->setProfilePicture($faker->imageUrl());
            $company->setAddress($faker->address());
            $company->setIban($faker->iban());
            $company->setDescription($faker->text(150));
            $company->setSiret((string)$faker->numberBetween(1111111, 9999999));

            $manager->persist($company);

            $companies[] = $company;
        }

        for ($i = 0; $i <= 4; $i++) {
            //BUYERS
            $buyer =  new Buyer();

            $buyer->setEmail($faker->email());
            $buyer->setFirstname($faker->firstName());
            $buyer->setLastname($faker->lastName());
            $buyer->setPassword($faker->password());
            $buyer->setProfilePicture($faker->imageUrl());

            $manager->persist($buyer);

            $buyers[] = $buyer;


            //VENDORS
            $vendor =  new Vendor();

            $vendor->setEmail($faker->email());
            $vendor->setFirstname($faker->firstName());
            $vendor->setLastname($faker->lastName());
            $vendor->setPassword($faker->password());
            $vendor->setProfilePicture($faker->imageUrl());
            $vendor->setCompany($faker->randomElement($companies));

            $manager->persist($vendor);

            $vendors[] = $vendor;


            // CATEGORIES
            $category = new Category();

            $category->setName($faker->text(8));
            $category->setDescription($faker->text(150));

            $manager->persist($category);

            $categories[] = $category;

            //COLLECTIONPOINT
            $collectionPoint = new CollectionPoint();

            $collectionPoint->setAddress($faker->address());
            $collectionPoint->setContact($faker->phoneNumber());
            $collectionPoint->setDate($faker->dateTime());
            $collectionPoint->setTitle($faker->text(8));

            $manager->persist($collectionPoint);

            $collectionPoints[] = $collectionPoint;
        }

        for ($i = 0; $i <= 15; $i++) {
            //ARTICLES
            $article = new Article();

            $article->setName($faker->text(8));
            $article->setDescription($faker->text(150));
            $article->setCategory($faker->randomElement($categories));
            $article->setOrigin($faker->city());
            $article->setPhoto($faker->imageUrl());
            $article->setQuantity($faker->numberBetween(1, 200));
            $article->setVendor($faker->randomElement($vendors));

            $article->setPrice($faker->numberBetween(1, 200));

            $manager->persist($article);

            $articles[] = $article;

            //ORDER
            $order = new Order();

            $order->setVendor($faker->randomElement($vendors));
            $order->setBuyer($faker->randomElement($buyers));
            $order->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $order->setPaymentMethod($faker->randomElement(PaymentType::getChoices()));
            $order->setCollectionPoint($faker->randomElement($collectionPoints));
            $order->setStatus($faker->boolean());
            $order->setTotalPrice($faker->numberBetween(20, 90));

            $manager->persist($order);

            $orders[] = $order;
        }

        foreach ($buyers as $buyer) {
            //CART
            $cart = new Cart();

            $cart->setBuyer($buyer);

            $manager->persist($cart);

            $carts[] = $cart;

            //CARTARTICLE
            $cartArticle = new CartArticle();

            $cartArticle->setArticle($faker->randomElement($articles));
            $cartArticle->setCart($faker->randomElement($carts));
            $cartArticle->setQuantity($faker->numberBetween(1, 200));

            $manager->persist($cartArticle);
        }

        for ($i = 5; $i <= 5; $i++) {
            //ORDERARTICLE
            $orderArticle = new OrderArticle();

            $orderArticle->setArticle($faker->randomElement($articles));
            $orderArticle->setCustomerOrder($faker->randomElement($orders));
            $orderArticle->setQuantity($faker->randomNumber());

            $manager->persist($orderArticle);
        }

        for ($i = 0; $i <= 5; $i ++) {
            //FEEDBACK
            $feedback = new Feedback();

            $feedback->setArticle($faker->randomElement($articles));
            $feedback->setBuyer($faker->randomElement($buyers));
            $feedback->setComment($faker->text(150));
            $feedback->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));

            $manager->persist($feedback);

            //NOTE
            $note = new Note();

            $note->setBuyer($faker->randomElement($buyers));
            $note->setVendor($faker->randomElement($vendors));
            $note->setNote($faker->numberBetween(0, 5));
            $note->setCreatedAd(\DateTimeImmutable::createFromMutable($faker->dateTime()));

            $manager->persist($note);
        }

        $manager->flush();
    }
}
