<?php

namespace App\Controller;

use App\Entity\Plate;
use App\Form\PlateType;
use App\Repository\PlateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/plate')]
final class PlateController extends AbstractController
{
    #[Route(name: 'app_plate_index', methods: ['GET'])]
    public function index(PlateRepository $plateRepository): Response
    {
        return $this->render('plate/index.html.twig', [
            'plates' => $plateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plate_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plate = new Plate();
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plate);
            $entityManager->flush();

            return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate/new.html.twig', [
            'plate' => $plate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plate_show', methods: ['GET'])]
    public function show(Plate $plate): Response
    {
        return $this->render('plate/show.html.twig', [
            'plate' => $plate,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plate_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Plate $plate, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate/edit.html.twig', [
            'plate' => $plate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plate_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Plate $plate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plate->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plate_index', [], Response::HTTP_SEE_OTHER);
    }
}
