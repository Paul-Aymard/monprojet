<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
         $user = $this->getUser();

        if (empty($user)) {

            return $this->redirectToRoute('app_login');

        }else {

            return $this->redirectToRoute('app_main');

        }
    }
    #[Route('/main', name: 'app_main')]
    public function main(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
