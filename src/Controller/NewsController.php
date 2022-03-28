<?php

namespace App\Controller;
use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news")
     */
    public function index(NewsRepository $newsRepository)
    {
      $lastNews = $newsRepository->findLastNews(6);
      //dd($lastNews);
        return $this->render('news/index.html.twig', [
            'lastNews' => $lastNews,
        ]);
    }


/**
     * @Route("/news/{id}", name="news_read")
     *
     * @return void
     */
    public function read(News $news)
    {
        return $this->render('news/read.html.twig', [
            'news' => $news,
        ]);
    
    }
/**
     * @Route("/add_news", name="add")
     */
     function add()
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);

        return $this->render('news/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

}


