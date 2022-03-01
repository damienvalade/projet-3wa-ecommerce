<?php

namespace App\Controller;

use App\Entity\Buyer;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/buyer')]
class BuyerRegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $buyer = new Buyer();
        $form = $this->createForm(RegistrationFormType::class, $buyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $buyer->setPassword(
                $userPasswordHasher->hashPassword(
                    $buyer,
                    $form->get('plainPassword')->getData()
                )
            );

            $buyer->setProfilePicture('');
            $entityManager->persist($buyer);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_buyer');
        }

        return $this->render('buyer/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
