<?php

namespace Module\TelegramMicroservice\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/telegram')]
class MainController extends AbstractController
{
    #[Route('/test_work')]
    public function testWork()
    {
        return $this->json(['ok telegram']);
    }
}