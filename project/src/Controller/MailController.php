<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/api/mail", name="app_mail")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(MailerInterface $mailer): Response
    {
        $user = new User();
        $user->setEmail('sonexcellence@orange-sonatel.com')
            ->setName('Son Excellence WADE')
            ->setTelephone('+221771295155')
            ->setIsActived('true');

        $email = (new Email())
            ->from('sonexcellence@orange-sonatel.com')
            ->to('papa.wade.1993@gmail.com')
            ->subject('Envoie de notification Email')
            ->text('Hello '.$user->getName(). ', nous venons de vous envoyer un email avec votre adresse electronique '.$user->getEmail());
        $mailer->send($email);


        return new Response('Email Sended Succesfull');

        /*return $this->render('mail/index.html.twig', [
            'email' => $email->getTextBody()
        ]);*/
    }
}
