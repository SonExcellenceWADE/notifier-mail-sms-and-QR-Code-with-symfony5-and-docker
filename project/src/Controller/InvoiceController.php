<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route("/api/invoice", name="app_invoice")
     */
    public function index(NotifierInterface $notifier, ManagerRegistry $doctrine): Response
    {
        $users =  $doctrine->getRepository(User::class)->findBy(['id' => 2]);

       foreach ($users as $user){

           $notification = (new Notification('Hello '.$user->getName()))
               ->content('Nous venons de vous envoyer une notification par email et sms')
               ->importance(Notification::IMPORTANCE_HIGH);

           // The receiver of the Notification
           $recipient = new Recipient($user->getEmail(), $user->getTelephone());
       }
        // Send the notification to the recipient
        $notifier->send($notification, $recipient);

        return new Response('Email and Sms Sended Succesfull');

        /*return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
        ]);*/
    }
}
