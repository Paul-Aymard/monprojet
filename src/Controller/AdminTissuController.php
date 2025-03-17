<?php

namespace App\Controller;

use App\Entity\Tissu;
use App\Form\TissuType;
use App\Repository\TissuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/tissu')]
final class AdminTissuController extends AbstractController
{
    #[Route(name: 'app_admin_tissu_index', methods: ['GET'])]
    public function index(TissuRepository $tissuRepository): Response
    {
        return $this->render('admin_tissu/index.html.twig', [
            'tissus' => $tissuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_tissu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tissu = new Tissu();
        $form = $this->createForm(TissuType::class, $tissu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tissu);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_tissu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_tissu/new.html.twig', [
            'tissu' => $tissu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_tissu_show', methods: ['GET'])]
    public function show(Tissu $tissu): Response
    {
        return $this->render('admin_tissu/show.html.twig', [
            'tissu' => $tissu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_tissu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tissu $tissu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TissuType::class, $tissu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_tissu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_tissu/edit.html.twig', [
            'tissu' => $tissu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_tissu_delete', methods: ['POST'])]
    public function delete(Request $request, Tissu $tissu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tissu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tissu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_tissu_index', [], Response::HTTP_SEE_OTHER);
    }
}
