<?php

namespace Module\GatewayMicroservice\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Module\GatewayMicroservice\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GatewayController extends AbstractController
{

    private Request $request;

    public function __construct(
        private ManagerRegistry $doctrine
    )
    {
        $this->request = new Request($_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }

    #[Route('/gateway', name: 'gateway')]
    public function gateway()
    {
        $token = $this->request->headers->get('token') ?? null;
        $module = $this->request->headers->get('module') ?? null;

        if (!empty($token) && !empty($module)) {
            $user = $this->doctrine->getRepository(User::class)->getUser($token, $module);
            if (null === $user) {
                return $this->json(['access denied']);
            } else {
                return $this->json($user);
            }
        } else {
            return $this->json(['access denied']);
        }

    }
}