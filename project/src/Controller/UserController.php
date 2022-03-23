<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("api/new/user", name="app_user")
     */
    public function index(UserService $userService): Response
    {
         $role = new  Role();
         $role->setTitle('ROLE_ADMIN');
        $user = new User();
        $user->setEmail('papa.wade.1993@gmail.com')
            ->setName('Abdoulaye WADE')
            ->setTelephone('+221771295155')
            ->setIsActived('true')
            ->addUserRole($role);

        $userService->createUser($user, $role);

        return new Response('User Created Successfully');

       /* return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);*/
    }
}
