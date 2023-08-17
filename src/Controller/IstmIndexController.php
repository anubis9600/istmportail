<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IstmIndexController extends AbstractController
{
    #[Route('/', name: 'app_istm_index')]
    public function index(ArticleRepository $articleRepository, EventRepository $eventRepository): Response
    {
        $articles = $articleRepository->findAll();
        $events = $eventRepository->findAll();
        
        return $this->render('istm_index/index.html.twig', [
            'controller_name' => 'IstmIndexController',
            'articles' => $articles,
            'events'  => $events,
        ]);
    }

    #[Route('/actualites_evenements', name: 'events_news-app')]
    public function event_news_index(ArticleRepository $articleRepository, EventRepository $eventRepository): Response
    {
        $articles = $articleRepository->findAll();
        $events = $eventRepository->findAll();

        return $this->render('istm_index/articles_events_index.html.twig', [
            'controller_name' => 'IstmIndexController',
            'articles' => $articles,
            'events'  => $events,
        ]);
    }

    #[Route('/nouvelle/{slug}', name: 'app_single_news')]
    public function single_news(ArticleRepository $articleRepository, $slug): Response
    {
        $article = $articleRepository->findOneBySlug($slug);

        return $this->render('istm_index/single_news.html.twig', [
            'controller_name' => 'IstmIndexController',
            'article' => $article,
        ]);
    }
    #[Route('/evenement/{slug}', name: 'app_single_event')]
    public function single_event(EventRepository $eventRepository, $slug): Response
    {
        $event = $eventRepository->findOneBySlug($slug);

        return $this->render('istm_index/single_event.html.twig', [
            'controller_name' => 'IstmIndexController',
            'event' => $event,
        ]);
    }
}