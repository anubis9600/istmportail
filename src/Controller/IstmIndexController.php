<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IstmIndexController extends AbstractController
{
    #[Route('/', name: 'app_istm_index')]
    public function index(): Response
    {
        return $this->render('istm_index/index.html.twig', [
            'controller_name' => 'IstmIndexController',
        ]);
    }

    #[Route('/actualites_evenements', name: 'events_news-app')]
    public function event_news_index(): Response
    {
        return $this->render('istm_index/articles_events_index.html.twig', [
            'controller_name' => 'IstmIndexController',
        ]);
    }
}
