<?php

namespace Module\MailMicroservice\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mail')]
class MainController extends AbstractController
{
    #[Route('/test_work')]
    public function testWork()
    {
        return $this->json(['mail ok']);
    }
}