<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Stopwatch\Stopwatch;

class CreateInvoiceCommand extends Command
{
    protected static $defaultName = 'app:send-mail-sms';
    protected static $defaultDescription = 'Send group mail and sms for users by Son Excellence WADE';

    /**
     * @var \App\Utils\SendMailHelper
     */

    private ManagerRegistry $doctrine;
    private NotifierInterface $notifier;
    private ParameterBagInterface $parameterBag;

    public function __construct(ManagerRegistry $doctrine, NotifierInterface $notifier, ParameterBagInterface $parameterBag)
    {
        parent::__construct();

        $this->parameterBag = $parameterBag;
        $this->doctrine = $doctrine;
        $this->notifier = $notifier;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
            ->setHelp('This command allows you to send a group email and sms for users');
        ;
    }

    /**
     * This optional method is the first one executed for a command after
     * configure() and is useful to initialize properties based on the input
     * arguments and options.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output) {$this->io = new SymfonyStyle($input, $output);}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start($this->getName());

        $users =  $this->doctrine->getRepository(User::class)->findBy(['name' => 'Son Excellence WADE']);

        if (!$users) {
            $this->io->note('Users are not found');
            $stopwatch->stop($this->getName());
            return false;
        }

        //Calling private method to send email and sms by Son Excellence WADE
        $this->sendingSmsEmail($users);

        $this->io->success(sprintf('was successfully sended email and sms for users by Son Excellence WADE'));
        $stopwatch->stop($this->getName());

        return Command::SUCCESS;
    }

    private function sendingSmsEmail($users = []){

        foreach ($users as $user){

            $notification = (new Notification('Alerte de Notification pour Mr '.$user->getName()))
                ->content('Par la présente, nous vous informons de votre rendez-vous pour la semaine prochaine !.
                Bonne Réception.
                Cordialement')
                ->emoji('@Author: Son Excellence WADE IT Engineer | Fullstack Developer')
                ->importance(Notification::IMPORTANCE_HIGH);

            // The receiver of the Notification
            $recipient = new Recipient($user->getEmail(), $user->getTelephone());
        }
        // Send the notification to the recipient
        $this->notifier->send($notification, $recipient);
    }
}
