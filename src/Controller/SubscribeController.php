<?php

namespace App\Controller;

use App\DTO\SubscriptionDTO;
use App\Entity\Subscription;
use App\Form\ManageSubscriptionType;
use App\Form\SubscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class SubscribeController extends AbstractController
{
    private $client;

    public function  __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/subscribe', name: 'app_subscribe')]
    public function index(Request $request): Response
    {
        $subs = new SubscriptionDTO();
        $form = $this->createForm(SubscriptionType::class, $subs);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = [
                'cvv' => $form->getData('cvv'),
                'card_number'=> $form->getData('card_number'),
                'user_id' => $form->getData('user_id')->getUserId()->getId()
            ];
            $response = $this->client->request(
                'POST',
                'http://adopteundev.adopteunmec.com:3042/user', [
                'body' => json_encode($data),
            ]
            );
            dd($response);
        }

        return $this->render('subscribe/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/subscribe/edit/{id}', name: 'subscription_edit')]
    public function edit(Subscription $sub, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ManageSubscriptionType::class, $sub);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Souscription modifié');
            return $this->redirectToRoute('app_backoffice');
        }

        return $this->render('subscribe/manage.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/subscribe/create', name: 'subscription_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $sub = new Subscription();
        $form = $this->createForm(ManageSubscriptionType::class, $sub);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sub);
            $em->flush();
            $this->addFlash('success', 'Souscription créer');
            return $this->redirectToRoute('app_backoffice');
        }

        return $this->render('subscribe/manage.html.twig', [
            'form' => $form,
        ]);
    }
}
