<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationIdentityType;
use App\Form\ReservationType;
use App\Entity\RestaurantTable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ReservationRepository;


class ReservationController extends AbstractController
{
    #[Route('/reserver', name: 'reserver')]
    #[IsGranted('ROLE_USER')]
    public function reserver(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUser($this->getUser());
            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Votre réservation a bien été enregistrée !');
            return $this->redirectToRoute('reserver');
        }

        return $this->render('main/reserver.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservation/nouvelle', name: 'reservation_nouvelle')]
    public function nouvelle(): Response
    {
        return $this->render('reservation/step1.html.twig');
    }

    #[Route('/reservation/choix-places', name: 'reservation_step2', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function step2(SessionInterface $session,\App\Repository\RestaurantTableRepository $tableRepository, \App\Repository\ReservationRepository $reservationRepository, Request $request, EntityManagerInterface $em): Response
    
    {
        // Si le formulaire de l'étape 1 est soumis
        if ($request->isMethod('POST')) {
            $couverts = $request->request->get('couverts');
            $date = $request->request->get('date');
            $horaire = $request->request->get('horaire');

            if (!$couverts || !$date || !$horaire) {
                $this->addFlash('error', 'Merci de remplir tous les champs.');
                return $this->redirectToRoute('reservation_nouvelle');
            }

            $session->set('reservation_data', [
                'couverts' => $couverts,
                'date' => $date,
                'horaire' => $horaire,
            ]);

            return $this->redirectToRoute('reservation_step2');
        }

        // Affichage GET
        $data = $session->get('reservation_data');
        if (!$data) {
            $this->addFlash('error', 'Veuillez d’abord remplir le formulaire de réservation.');
            return $this->redirectToRoute('reservation_nouvelle');
        }

        $tables = $tableRepository->findAll();

        // Récupérer les réservations existantes pour cette date et cet horaire
        $reservations = $reservationRepository->findBy([
            'date' => new \DateTime($data['date']),
            'horaire' => $data['horaire'],
        ]);

        $occupiedSeats = [];

        foreach ($reservations as $res) {
            foreach ($res->getTables() as $table) {
                $occupiedSeats[$table->getId()] = range(1, $table->getCapacity()); // Toutes les places de la table sont considérées occupées
            }
        }



        // Tables indisponibles à cette date et cet horaire
        $reservationsExistantes = $em->getRepository(Reservation::class)
            ->findBy(['date' => new \DateTime($data['date']), 'horaire' => $data['horaire']]);

        $tablesIndisponibles = [];

        foreach ($reservationsExistantes as $resa) {
            foreach ($resa->getTables() as $table) {
                $tablesIndisponibles[] = $table->getId();
            }
        }



        return $this->render('reservation/step2.html.twig', [
            'tables' => $tables,
            'couverts' => $data['couverts'],
            'date' => $data['date'],
            'horaire' => $data['horaire'],
            'tablesIndisponibles' => $tablesIndisponibles,
            'occupied_seats' => $occupiedSeats,
        ]);
    }

    #[Route('/reservation/choix-places/process', name: 'reservation_step2_process', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function processStep2(Request $request, SessionInterface $session): Response
    {
        $selectedSeats = $request->request->get('selected_seats');

        $data = $session->get('reservation_data');
        if (!$data) {
            $this->addFlash('error', 'Session expirée, recommencez votre réservation.');
            return $this->redirectToRoute('reservation_nouvelle');
        }

        $data['selected_seats'] = $selectedSeats;
        $session->set('reservation_data', $data);

        return $this->redirectToRoute('reservation_step3');
    }

    #[Route('/reservation/infos', name: 'reservation_step3')]
    #[IsGranted('ROLE_USER')]
    public function step3(Request $request, SessionInterface $session, EntityManagerInterface $em): Response
    {
        $data = $session->get('reservation_data');
        if (!$data) {
            $this->addFlash('error', 'Données manquantes. Veuillez recommencer la réservation.');
            return $this->redirectToRoute('reservation_nouvelle');
        }
    
        $user = $this->getUser();
    
        // Le formulaire est directement lié à l'utilisateur connecté
        $identityForm = $this->createForm(ReservationIdentityType::class, $user);
        $identityForm->handleRequest($request);
    
        if ($identityForm->isSubmitted() && $identityForm->isValid()) {
            $selectedSeats = json_decode($data['selected_seats'], true);
    
            $reservation = new Reservation();
            $reservation->setUser($user);
            $reservation->setNbCouverts($data['couverts']);
            $reservation->setDate(new \DateTime($data['date']));
            $reservation->setHoraire($data['horaire']);
            $reservation->setCivilite($user->getCivilite());
            $reservation->setPrenom($user->getPrenom());
            $reservation->setNom($user->getNom());
            $reservation->setTelephone($user->getTelephone());
            $reservation->setEmail($user->getEmail());
    
            foreach ($selectedSeats as $seat) {
                $table = $em->getRepository(RestaurantTable::class)->find($seat['table']);
                if ($table) {
                    $reservation->addTable($table);
                }
            }
    
            $em->persist($reservation);
            $em->flush();
    
            $this->addFlash('success', 'Réservation confirmée !');
            return $this->redirectToRoute('home');
        }
    
        return $this->render('reservation/step3.html.twig', [
            'form' => $identityForm->createView(),
        ]);
    }
    
    



    
}
