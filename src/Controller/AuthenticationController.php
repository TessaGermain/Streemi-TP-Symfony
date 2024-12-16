<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/reset/{token}', name: 'reset')]
    public function resetPassword(Request $request, string $token): Response
    {
        // Search for user by resetToken
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('error', 'Le token de réinitialisation est invalide ou expiré.');
            return $this->redirectToRoute('forgot_password');
        }

        // Handle POST request to process the form
        if ($request->isMethod('POST')) {
            $password = $request->request->get('password');
            $passwordConfirm = $request->request->get('password_confirm');

            if ($password !== $passwordConfirm) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('reset_password', ['token' => $token]);
            }

            // Hash and set the new password
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
            $user->setResetToken(null); // Optionally clear the reset token

            // Save changes
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }

        // Display the reset password form
        return $this->render('reset.html.twig', [
            'token' => $token
        ]);
    }

    #[Route('/forgot', name: 'forgot')]
    public function forgot(Request $request): Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('auth/forgot.html.twig');
        }

        $email = $request->request->get('email');

        if (!$email) {
            $this->addFlash('error', 'Veuillez fournir une adresse email.');
            return $this->redirectToRoute('forgot_password');
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse email.');
            return $this->redirectToRoute('forgot_password');
        }

        // Generate reset token
        $resetToken = Uuid::v4();
        $user->setResetToken($resetToken);

        // Save user entity
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->addFlash('success', 'Un email avec le lien de réinitialisation de mot de passe a été envoyé.');

        // Redirect to avoid resubmission
        return $this->redirectToRoute('forgot_password');
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
