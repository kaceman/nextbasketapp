<?php

namespace App\Controller;

use App\Entity\User;
use App\Message\UserCreatedMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'store_user', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MessageBusInterface $bus): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        $entityManager->persist($user);
        $entityManager->flush();

        $event = new UserCreatedMessage($data);
        $bus->dispatch($event);

        return $this->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }
}
