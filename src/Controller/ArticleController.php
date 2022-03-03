<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    #[Route('/show/{id}', name: 'article_show')]
    public function index(int $id, ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'article' => $articleRepository->findOneBy(['id' => $id]),
        ]);
    }
}
