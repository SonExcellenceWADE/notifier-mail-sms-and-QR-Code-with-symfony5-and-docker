<?php


namespace App\Service;


use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;


class EmailService implements MessageHandlerInterface
{
    private MailerInterface $mailer;
    const EMAIL_EMETTEUR = 'sonexcellence@orange-sonateL.com';

  public function __construct(MailerInterface $mailer)
  {
      $this->mailer = $mailer;
  }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */

    public function __invoke(User $user)
    {
        // TODO: Implement __invoke() method.

        $email = (new Email())
            ->from(self::EMAIL_EMETTEUR)
            ->to($user->getEmail())
            ->subject('Rendez-Vous')
            ->text(
                'Bonjour ' .$user->getName(). ' '.
               'Par la présente, nous vous informons de votre rendez-vous pour la semaine prochaine !.
               Bonne Réception.
               Cordialement !!!');

        sleep(10);

        dd($email);

        $this->mailer->send($email);
    }
}