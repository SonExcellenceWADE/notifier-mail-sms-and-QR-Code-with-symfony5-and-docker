<?php


namespace App\Service;


use Doctrine\Persistence\ManagerRegistry;

class UserService
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

    }

    public function createUser($user){

   $this->doctrine->getManager()->persist($user);
   $this->doctrine->getManager()->flush();

    }

}