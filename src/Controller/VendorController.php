<?php

namespace App\Controller;

use App\Repository\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/vendor', name: 'vendor_')]
class VendorController extends AbstractController
{
    #[Route(path: '/', name: 'view')]
    public function viewAllAction(VendorRepository $vendorRepository): Response
    {
        $vendors = $vendorRepository->findAll();

        return $this->render('vendor/vendor.html.twig', [
            'vendors' => $vendors
        ]);
    }

    #[Route(path: '/view/{id}', name: 'view')]
    public function viewAction(int $id, VendorRepository $vendorRepository): Response
    {
        return $this->render('vendor/vendor.html.twig', [
            'vendor' => $vendorRepository->findOneBy(['id' => $id])
        ]);
    }
}
