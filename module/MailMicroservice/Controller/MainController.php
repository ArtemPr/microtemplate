<?php

namespace Module\MailMicroservice\Controller;

use Module\MailMicroservice\Adapter\GatewayAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/mail')]
class MainController extends AbstractController
{
    public function __construct(
        private readonly GatewayAdapter $adapter,
        private readonly HttpClientInterface $httpClient
    )
    {
    }

    #[Route('/', name: 'mail')]
    public function index()
    {
        return $this->json(
            [
                'access denied'
            ]
        );
    }

    #[Route('/send', name: 'mail_send', methods: 'GET')]
    public function send()
    {
        $auth = $this->adapter->get('mail', $this->httpClient);
        if (!empty($auth)) {

            /**
             * тут пишется основная работа
             */

            return $this->json(['mail ok']);
        } else {
            return $this->index();
        }
    }
}