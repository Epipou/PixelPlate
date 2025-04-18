<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ChangePasswordType;
use App\Form\EditUserType;




class UserController extends AbstractController
{
    #[Route('/profil/mes-reservations', name: 'user_reservations')]
    #[IsGranted('ROLE_USER')]
    public function mesReservations(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = $reservationRepository->findBy(['user' => $user], ['date' => 'DESC']);

        return $this->render('user/mes_reservations.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/profil/infos', name: 'user_infos')]
    #[IsGranted('ROLE_USER')]
    public function infos(): Response
    {
        $user = $this->getUser();

        return $this->render('user/infos.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/modifier-mot-de-passe', name: 'app_change_password')]
    #[IsGranted('ROLE_USER')]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
{
    /** @var \App\Entity\User $user */
    $user = $this->getUser();

    $form = $this->createForm(ChangePasswordType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $currentPassword = $form->get('currentPassword')->getData();
        $newPassword = $form->get('newPassword')->getData();

        if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
            $this->addFlash('error', 'Le mot de passe actuel est incorrect.');
        } else {
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);

            $em->flush();
            $this->addFlash('success', 'Mot de passe modifié avec succès.');
            return $this->redirectToRoute('user_infos');
        }
    }

    return $this->render('user/change_password.html.twig', [
        'form' => $form->createView(),
    ]);
    }



    #[Route('/profil/modifier-infos', name: 'user_edit_infos')]
    #[IsGranted('ROLE_USER')]
    public function editInfos(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Vos informations ont été mises à jour.');
            return $this->redirectToRoute('user_infos');
        }

        return $this->render('user/edit_infos.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profil/supprimer-compte', name: 'user_delete_account', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function deleteAccount(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if ($this->isCsrfTokenValid('delete_account', $request->request->get('_token'))) {
            // Déconnexion manuelle si nécessaire
            $session = $request->getSession();
            $session->invalidate();

            $em->remove($user);
            $em->flush();

            $this->addFlash('success', 'Votre compte a été supprimé avec succès.');
            return $this->redirectToRoute('home');
        }

        $this->addFlash('error', 'Échec de la suppression du compte.');
        return $this->redirectToRoute('user_infos');
    }



}
