<?php

namespace App\Controller;

use App\Entity\Buyer;
use App\Entity\User;
use App\Entity\Vendor;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vendor')]
class VendorRegistrationController extends AbstractController
{
    #[Route('/register', name: 'vendor_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $vendor = new Vendor();
        $form = $this->createForm(RegistrationFormType::class, $vendor, [
            'data_class' => Vendor::class,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $vendor->setPassword(
                $userPasswordHasher->hashPassword(
                    $vendor,
                    $form->get('plainPassword')->getData()
                )
            );

            $vendor->setProfilePicture('');
            $entityManager->persist($vendor);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_vendor');
        }

        return $this->render('vendor/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
