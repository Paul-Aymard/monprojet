<?php

namespace App\Controller;

use App\Entity\Alerte;
use App\Form\AlerteType;
use App\Repository\AlerteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use DateTimeImmutable;

#[Route('/admin/alerte')]
final class AdminAlerteController extends AbstractController
{
    #[Route(name: 'app_admin_alerte_index', methods: ['GET'])]
    public function index(AlerteRepository $alerteRepository): Response
    {
        return $this->render('admin_alerte/index.html.twig', [
            'alertes' => $alerteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_alerte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alerte = new Alerte();
        // $alerte -> setCreatedAt(new DateTimeImmutable());
        $form = $this->createForm(AlerteType::class, $alerte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alerte);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_alerte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_alerte/new.html.twig', [
            'alerte' => $alerte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_alerte_show', methods: ['GET'])]
    public function show(Alerte $alerte): Response
    {
        return $this->render('admin_alerte/show.html.twig', [
            'alerte' => $alerte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_alerte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alerte $alerte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlerteType::class, $alerte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_alerte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_alerte/edit.html.twig', [
            'alerte' => $alerte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_alerte_delete', methods: ['POST'])]
    public function delete(Request $request, Alerte $alerte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alerte->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($alerte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_alerte_index', [], Response::HTTP_SEE_OTHER);
    }
}
