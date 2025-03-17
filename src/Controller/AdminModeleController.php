<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Form\ModeleType;
use App\Repository\ModeleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/modele')]
final class AdminModeleController extends AbstractController
{
    #[Route(name: 'app_admin_modele_index', methods: ['GET'])]
    public function index(ModeleRepository $modeleRepository): Response
    {
        return $this->render('admin_modele/index.html.twig', [
            'modeles' => $modeleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_modele_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modele);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_modele_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_modele/new.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_modele_show', methods: ['GET'])]
    public function show(Modele $modele): Response
    {
        return $this->render('admin_modele/show.html.twig', [
            'modele' => $modele,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_modele_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Modele $modele, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_modele_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_modele/edit.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_modele_delete', methods: ['POST'])]
    public function delete(Request $request, Modele $modele, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modele->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($modele);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_modele_index', [], Response::HTTP_SEE_OTHER);
    }
}
