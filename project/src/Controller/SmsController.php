<?php

namespace App\Controller;


use App\Entity\User;
use App\Service\SmsService;
use Symfony\Component\Notifier\TexterInterface;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmsController extends AbstractController
{
    /**
     * @Route("/api/sms", name="app_sms")
     * @throws \Symfony\Component\Notifier\Exception\TransportExceptionInterface
     */
    public function index(ManagerRegistry $doctrine, SmsService $smsService): Response
    {
        $user =  $doctrine->getRepository(User::class)->find(2);

        $smsService->sendSMS($user);

        return new Response('SMS Sended Successfully');


    }
}
