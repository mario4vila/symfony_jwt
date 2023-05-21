<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function __construct(
        private readonly Security $security,
    )
    {

    }

    #[Route('/api/order', name: 'app_order')]
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = $this->security->getUser();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OrderController.php',
            'user' => json_encode($user),
        ]);
    }
}
