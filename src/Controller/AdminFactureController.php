<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/facture')]
final class AdminFactureController extends AbstractController
{
    #[Route(name: 'app_admin_facture_index', methods: ['GET'])]
    public function index(FactureRepository $factureRepository): Response
    {
        // tableau pour récupérer les données de la base de données
        $data = array();

        foreach ($factureRepository->findAll() as $key => $value) {
            
            $data[$key]['id'] = $value->getId();
            $data[$key]['dat_factAt'] = $value->getDatFactAt()->format('d/m/Y');
            $data[$key]['mont_fact'] = $value->getMontFact();
            $data[$key]['nom_emp'] = $value->getNomEmp()->getNomEmp();
            $data[$key]['nom_cli'] = $value->getNomCli()->getNomCli();

        } 

        return $this->render('admin_facture/index.html.twig', [
            'factures' => $data,
        ]);
    }

    #[Route('/new', name: 'app_admin_facture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_facture_show', methods: ['GET'])]
    public function show(Facture $facture): Response
    {
        return $this->render('admin_facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_facture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_facture_delete', methods: ['POST'])]
    public function delete(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($facture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_facture_index', [], Response::HTTP_SEE_OTHER);
    }
}
