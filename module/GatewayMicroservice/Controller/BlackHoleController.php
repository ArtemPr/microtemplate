<?php

namespace Module\GatewayMicroservice\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlackHoleController extends AbstractController
{
    #[Route('/', name: 'index_page')]
    public function index()
    {
        return $this->json(
            [
                'access denied'
            ]
        );
    }
}