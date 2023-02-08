<?php

namespace Module\GatewayMicroservice\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GatewayController extends AbstractController
{
    #[Route('/', name: '')]
    public function gateway()
    {
        return $this->json(['gateway']);
    }
}