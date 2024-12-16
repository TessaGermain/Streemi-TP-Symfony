<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MediaRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function home(
        MediaRepository $mediaRepository
    ): Response
    {
        // $medias = $mediaRepository->findPopular(10);
        return $this->render('index.html.twig');
    }
}
