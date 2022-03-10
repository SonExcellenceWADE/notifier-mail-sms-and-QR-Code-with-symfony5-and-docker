<?php

namespace App\Controller;

use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

use App\Entity\User;
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
    public function index(ManagerRegistry $doctrine, TexterInterface $texter): Response
    {
        $entityManager = $doctrine->getManager();

       $user = new User();
       $user->setEmail('sonexcellence@orange-sonatel.com')
           ->setName('Son Excellence WADE')
           ->setTelephone('+221771295155')
           ->setIsActived('true');

        $sms = new SmsMessage(
        // the phone number to send the SMS message to
            $user->getTelephone(),
            // the message
            'Hello '.$user->getName(). ', nous venons de vous envoyer un sms sur votre numero '.$user->getTelephone()
        );

        $texter->send($sms);

        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('SMS Sended Succesfull');


    }
}
