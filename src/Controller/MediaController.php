<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function category(): Response
    {
        return $this->render('media/category.html.twig');
    }

    #[Route('/detail_serie', name: 'detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render('media/detail_serie.html.twig');
    }

    #[Route('/detail', name: 'detail')]
    public function detail(): Response
    {
        return $this->render('media/detail.html.twig');
    }

    #[Route('/discover', name: 'discover')]
    public function discover(): Response
    {
        return $this->render('media/discover.html.twig');
    }

    #[Route('/upload', name: 'upload')]
    public function upload(): Response
    {
        return $this->render('media/upload.html.twig');
    }

}
