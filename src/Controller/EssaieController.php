<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class EssaieController extends AbstractController
{
    #[Route('/essaie', name: 'app_essaie')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $connection = $doctrine->getConnection();
        $result = $connection->fetchAllAssociative('SELECT * FROM essaie');
        dd($result);

        return $this->render('essaie/index.html.twig', [
            'controller_name' => 'EssaieController',
        ]);
    }
}
