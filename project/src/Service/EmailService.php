<?php


namespace App\Service;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class EmailService
{
    private $mailer;
    const EMAIL_EMETTEUR = 'sonexcellence@orange-sonateL.com';
  public function __construct(MailerInterface $mailer)
  {
      $this->mailer = $mailer;
  }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function SendEmail($user)
  {
      $email = (new Email())
          ->from(self::EMAIL_EMETTEUR)
          ->to($user->getEmail())
          ->subject('Rendez-Vous')
          ->text(
              'Bonjour M.' .$user->getName(). ' '.
               'Par la présente, nous vous informons de votre rendez-vous pour la semaine prochaine !.
               Bonne Réception.
               Cordialement !!!');

      $this->mailer->send($email);
  }
}