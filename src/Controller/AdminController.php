<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Menu;
use App\Entity\Plate;
use App\Entity\Reservation;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\ReservationRepository;
use App\Form\EditReservationType;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboard(
        Request $request,
        UserRepository $userRepository,
        PaginatorInterface $paginator
    ): Response {
        $search = $request->query->get('search');
        $queryBuilder = $userRepository->createQueryBuilder('u');

        if ($search) {
            $queryBuilder->where('u.name LIKE :search OR u.email LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin/dashboard.html.twig', [
            'users' => $pagination,
            'search' => $search,
        ]);
    }

    #[Route('/admin/user/{id}/edit-roles', name: 'admin_edit_roles')]
    #[IsGranted('ROLE_ADMIN')]
    public function editUserRoles(User $user, Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $roles = $request->request->all('roles');
            $validRoles = ['ROLE_USER', 'ROLE_ADMIN'];
            $filteredRoles = array_values(array_intersect($roles, $validRoles));

            $user->setRoles($filteredRoles);
            $em->flush();

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/edit_roles.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin/carte', name: 'admin_carte')]
    #[IsGranted('ROLE_ADMIN')]
    public function carte(Request $request, EntityManagerInterface $em): Response
    {
        $plate = new Plate();
        $menu = new Menu();

        // ✅ On ajoute des IDs différents aux 2 formulaires
        $plateForm = $this->createForm(\App\Form\PlateType::class, $plate, [
            'attr' => ['id' => 'form_plate']
        ]);
        $plateForm->handleRequest($request);

        $menuForm = $this->createForm(\App\Form\MenuType::class, $menu, [
            'attr' => ['id' => 'form_menu']
        ]);
        $menuForm->handleRequest($request);

        // Formulaire plat
        if ($plateForm->isSubmitted() && $plateForm->isValid()) {
            $spineFile = $plateForm->get('imageSpine')->getData();
            $frontFile = $plateForm->get('imageFront')->getData();

            if ($spineFile) {
                $spineName = uniqid() . '_spine.' . $spineFile->guessExtension();
                $spineFile->move($this->getParameter('images_directory'), $spineName);
                $plate->setImageSpine($spineName);
            }

            if ($frontFile) {
                $frontName = uniqid() . '_front.' . $frontFile->guessExtension();
                $frontFile->move($this->getParameter('images_directory'), $frontName);
                $plate->setImageFront($frontName);
            }

            $em->persist($plate);
            $em->flush();

            $this->addFlash('success', 'Plat ajouté avec ses images !');
            return $this->redirectToRoute('admin_carte');
        }

        // Formulaire menu
        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
            $em->persist($menu);
            $em->flush();

            $this->addFlash('success', 'Menu ajouté avec succès.');
            return $this->redirectToRoute('admin_carte');
        }

        return $this->render('admin/carte.html.twig', [
            'plateForm' => $plateForm->createView(),
            'menuForm' => $menuForm->createView(),
            'plates' => $em->getRepository(Plate::class)->findAll(),
            'menus' => $em->getRepository(Menu::class)->findAll(),
        ]);
    }

    #[Route('/admin/reservations', name: 'admin_reservations')]
    #[IsGranted('ROLE_ADMIN')]
    public function reservations(ReservationRepository $repo): Response
    {
        return $this->render('admin/reservations.html.twig', [
            'reservations' => $repo->findBy([], ['date' => 'DESC', 'horaire' => 'DESC']),
        ]);
    }

    #[Route('/admin/reservation/{id}/edit', name: 'admin_reservation_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editReservation(
        Reservation $reservation,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(EditReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Réservation mise à jour.');
            return $this->redirectToRoute('admin_reservations');
        }

        return $this->render('admin/edit_reservation.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }

    #[Route('/admin/reservation/{id}/delete', name: 'admin_reservation_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteReservation(
        Reservation $reservation,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        if ($this->isCsrfTokenValid('delete_reservation_'.$reservation->getId(), $request->request->get('_token'))) {
            $em->remove($reservation);
            $em->flush();
            $this->addFlash('success', 'Réservation supprimée.');
        }

        return $this->redirectToRoute('admin_reservations');
    }


    #[Route('/admin/plate/{id}/delete', name: 'admin_delete_plate', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deletePlate(\App\Entity\Plate $plate, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_plate_' . $plate->getId(), $request->request->get('_token'))) {
            $em->remove($plate);
            $em->flush();
            $this->addFlash('success', 'Plat supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_carte');
    }

    #[Route('/admin/menu/{id}/delete', name: 'admin_delete_menu', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteMenu(\App\Entity\Menu $menu, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_menu_' . $menu->getId(), $request->request->get('_token'))) {
            $em->remove($menu);
            $em->flush();
            $this->addFlash('success', 'Menu supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_carte');
    }

}


