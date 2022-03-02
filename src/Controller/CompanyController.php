<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private EntityManagerInterface $em,
    ) {
    }

    #[Route('/company/list', name: 'company_list', methods: ['GET'])]
    public function list(): Response {
        $companies = $this->companyRepository->findAll();

        return $this->render('company/list.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/company/new', name: 'company_new')]
    #[Route('/company/{id}/edit', name: 'company_edit', methods: ['POST', 'GET'])]
    public function newOrEdit(
        Request $request,
        Company|null $company = null
    ): Response {
        if (!$company) {
            $company = new Company();
        }

        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($company);
            $this->em->flush();

            return $this->redirectToRoute('company_show', [
                'id' => $company->getId(),
            ]);
        }

        return $this->renderForm('company/new_or_edit.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    #[Route('/company/{id}/show', name: 'company_show', methods: ['GET'])]
    public function show(
        Company $company
    ): Response {
        return $this->renderForm('company/show.html.twig', [
            'company' => $company,
        ]);
    }
}
