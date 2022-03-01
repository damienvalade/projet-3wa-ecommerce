<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $listArticle = [];

        for ($i=0; $i < 20; $i++) { 
            $article =[];
            $article['name'] = "name".$i;
            $article['desc'] = "akznepkaz akz azn eanzrnazk nranz ranzr naẑnr ânzrnazn raztr ant nakzn anzfnân aef anzf nanz ĝnag nzfnazganzgfna âaĝna";
            $article['price'] = $i +10;
            $article['origin'] = 'fr';
            $article['category'] = "category".$i;
             array_push($listArticle,$article);

        }
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $listArticle
        ]);
    }
}
