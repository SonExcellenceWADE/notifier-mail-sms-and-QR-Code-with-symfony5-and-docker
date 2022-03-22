<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\EmailService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/api/mail", name="app_mail")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $user =  $doctrine->getRepository(User::class)->find(1);

        $this->dispatchMessage($user);

        return new Response('Email Sended Successfully');

    }
}
