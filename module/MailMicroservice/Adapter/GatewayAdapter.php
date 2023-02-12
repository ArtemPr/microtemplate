<?php

namespace Module\MailMicroservice\Adapter;


use Doctrine\Persistence\ManagerRegistry;
use Module\GatewayMicroservice\Entity\User;
use Module\GatewayMicroservice\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GatewayAdapter
{

    private Request $request;

    public function __construct()
    {
        $this->request = new Request($_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function get(string $module, HttpClientInterface $httpClient): array|false|null
    {

        $token = $this->request->headers->get('token') ?? null;

        $response = $httpClient->request(
            'GET',
            'https://' . $_SERVER['HTTP_HOST'] . '/gateway',
            [
                'headers' => [
                    'token' => $token,
                    'module' => $module,
                    'Accept' => 'application/json',
                ]
            ]
        );

        if (!empty($result)) {
            $result = json_decode($response->getContent());

            if (!empty($result['0'] && $result[0] === 'access denied')) {
                return false;
            }

            return $result;
        }

        return false;
    }
}