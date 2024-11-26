<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryRepository;
use App\Entity\Category;

class MediaController extends AbstractController
{
    #[Route('/category/{id}', name: 'category')]
    public function category(
        string $id,
        Category $category
    ): Response
    {
        return $this->render('media/category.html.twig', [
            'category' => $category
        ]);
    }

    #[Route('/detail_serie', name: 'detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render('media/detail_serie.html.twig');
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(
        string $id,
        Movie $movie
    ): Response
    {
        return $this->render('media/detail.html.twig', [
            'movie' => $movie
        ]);
    }

    #[Route('/discover', name: 'discover')]
    public function discover(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
    ): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('media/discover.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/upload', name: 'upload')]
    public function upload(): Response
    {
        return $this->render('media/upload.html.twig');
    }

}
