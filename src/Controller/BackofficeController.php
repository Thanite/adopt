<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BackofficeController extends AbstractController
{
    #[Route('/backoffice', name: 'app_backoffice')]
    public function index(SubscriptionRepository $subRepo): Response
    {
        $subs = $subRepo->findAll();

        return $this->render('backoffice/index.html.twig', [
            'subs' => $subs,
        ]);
    }

    #[Route('/backoffice/createUser', name : 'createUser')]
    public function createUser(EntityManagerInterface $em) : Response
    {
        $user = new User();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app_subscribe');
    }
}
