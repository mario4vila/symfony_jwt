<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly PasswordHasherInterface $passwordHasher,
        private readonly UserRepository          $userRepository,
    )
    {
    }

    #[Route('/api/user', name: 'app_registration', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $plaintextPassword = $decoded->password;

        $user = new User();
        $hashedPassword = $this->passwordHasher->hash(
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setEmail($email);
        $this->userRepository->save($user, true);

        return $this->json(['message' => 'Registered Successfully']);
    }
}
