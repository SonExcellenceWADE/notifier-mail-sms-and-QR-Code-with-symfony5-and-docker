<?php


namespace App\Service;


use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

class SmsService
{

    private TexterInterface $texter;

    public function __construct(TexterInterface $texter)
    {
        $this->texter = $texter;
    }

    /**
     * @throws \Symfony\Component\Notifier\Exception\TransportExceptionInterface
     */
    public function sendSMS($user){

        $sms = new SmsMessage(
        // the phone number to send the SMS message to
            $user->getTelephone(),
            // the message
            'Bonjour M. ' .$user->getName(). ' '.
               'Par la presente, nous vous informons de votre rendez-vous pour la semaine prochaine !.
                Bonne Reception.
                Cordialement !!!'
               );

        $this->texter->send($sms);

    }

}