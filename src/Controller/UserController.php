<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SubscriptionRepository;

class UserController extends AbstractController
{
    #[Route('/subscription', name: 'subscription')]
    public function subscription(
        EntityManagerInterface $entityManager,
        SubscriptionRepository $subscriptionRepository,
    ): Response
    {
        $subscriptions = $subscriptionRepository->findAll();
        return $this->render('profile/abonnements.html.twig', [
            'subscriptions'=> $subscriptions
        ]);
    }

    #[Route('/lists/{id}', name: 'lists')]
    public function lists(
        string $id,
    ): Response
    {
        return $this->render('profile/lists.html.twig');
    }

    #[Route('/default/{id}', name: 'default')]
    public function default(
        string $id
    ): Response
    {
        return $this->render('profile/default.html.twig');
    }
}
