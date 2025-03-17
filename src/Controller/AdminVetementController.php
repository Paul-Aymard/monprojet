<?php

namespace App\Controller;

use App\Entity\Vetement;
use App\Form\VetementType;
use App\Repository\VetementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/vetement')]
final class AdminVetementController extends AbstractController
{
    #[Route(name: 'app_admin_vetement_index', methods: ['GET'])]
    public function index(VetementRepository $vetementRepository): Response
    {
        return $this->render('admin_vetement/index.html.twig', [
            'vetements' => $vetementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_vetement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vetement = new Vetement();
        $form = $this->createForm(VetementType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vetement);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_vetement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_vetement/new.html.twig', [
            'vetement' => $vetement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_vetement_show', methods: ['GET'])]
    public function show(Vetement $vetement): Response
    {
        return $this->render('admin_vetement/show.html.twig', [
            'vetement' => $vetement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_vetement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VetementType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_vetement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_vetement/edit.html.twig', [
            'vetement' => $vetement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_vetement_delete', methods: ['POST'])]
    public function delete(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vetement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vetement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_vetement_index', [], Response::HTTP_SEE_OTHER);
    }
}
