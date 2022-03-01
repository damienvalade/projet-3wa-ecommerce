<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Buyer;
use App\Entity\Category;
use App\Entity\Company;
use App\Entity\User;
use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        $companies = [];
        $categories = [];
        $vendors = [];

        for ($i = 0; $i <= 2; $i++) {
            $company = new Company();

            $company->setName($faker->company());
            $company->setProfilePicture($faker->imageUrl());
            $company->setAddress($faker->address());
            $company->setIban($faker->iban());
            $company->setDescription($faker->text('150'));
            $company->setSiret($faker->numberBetween(1111111, 9999999));

            $companies[] = $company;
        }


        for ($i = 0; $i <= 4; $i++) {
            $buyer =  new Buyer();

            $buyer->setEmail($faker->email());
            $buyer->setFirstname($faker->firstName());
            $buyer->setLastname($faker->lastName());
            $buyer->setPassword($faker->password());
            $buyer->setProfilePicture($faker->imageUrl());

            $vendor =  new Vendor();

            $vendor->setEmail($faker->email());
            $vendor->setFirstname($faker->firstName());
            $vendor->setLastname($faker->lastName());
            $vendor->setPassword($faker->password());
            $vendor->setProfilePicture($faker->imageUrl());
            $vendor->setCompany($faker->randomElement($companies));

            $vendors[] = $vendor;
        }

        for ($i = 0; $i <= 4; $i++) {
            $category = new Category();

            $category->setName($faker->text(8));
            $category->setDescription($faker->text(150));

            $categories[] = $category;
        }

        for ($i = 0; $i <= 15; $i++) {
            $article = new Article();

            $article->setName($faker->text(8));
            $article->setDescription($faker->text(150));
            $article->setCategory($faker->randomElement($categories));
            $article->setOrigin($faker->city());
            $article->setPhoto($faker->imageUrl());
            $article->setQuantity($faker->numberBetween(1, 200));
            $article->setVendor($faker->randomElement($vendors));
        }

        $manager->flush();
    }
}