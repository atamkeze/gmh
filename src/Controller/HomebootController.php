<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\UserAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class HomebootController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }



// // Verify if Username and Email already exists and return an error message
//     public function user_exists()
//     {

//         $isUser = false;
//         if ($this->getUser()->getUsername() ==  $this->getUser()) {
//             $isUser = true;
//             return $this->redirectToRoute("look_up", [
//                 $isUser => 'isUser',
//             ]);
//         }
//     }

    
// CREATE ADMIN'S ACCOUNT
    /**
     * @Route("/register-admin", name="app_register_admin")
     */
    public function app_register_admin(Request $request, UserAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler)
    {

        $datas = $request->request->all();
       
// Verify if Username and Email already exists and return an error message
    $repository = $this->getDoctrine()->getRepository(User::class);
    $users = $repository->findBy(['username' => $datas['username']]);
      $is_yet = false;
        foreach ($users as $user) {
            if ($user->getUsername() == $datas['username']) {
                $is_yet = true;
            }
        }

        if ($is_yet == true) {//If the username exists already
            return $this->redirectToRoute('init_admin_activation', [$is_yet => 'is_yet']);
        }


        $user = new User;
        $user->setName($datas['name']);
        $user->setUsername($datas['username']);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $datas['pass2']
        ));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // User Authentication
        $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main'
        );
        return $this->redirectToRoute('look_up');

    }

// CREATE ARTIST'S ACCOUNT
    /**
     * @Route("/register-artist", name="app_register_artist")
     */
    public function app_register_artist(Request $request, UserAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler)
    {
        $datas = $request->request->all();

// Verify if Username and Email already exists and return an error message
    $repository = $this->getDoctrine()->getRepository(User::class);
    $users = $repository->findBy(['username' => $datas['username']]);
      $is_yet = false;
        foreach ($users as $user) {
            if ($user->getUsername() == $datas['username']) {
                $is_yet = true;
            }
        }

        if ($is_yet == true) {//If the username exists already
            return $this->redirectToRoute('app_register_artist_form', [$is_yet => 'is_yet']);
        }

        $user = new User;
        $user->setName($datas['name']);
        $user->setUsername($datas['username']);
        $user->setRoles(["ROLE_ARTIST"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $datas['pass2']
        ));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // User Authentication
        $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main'
        );
        return $this->redirectToRoute('look_up');

    }

// CREATE FAN'S ACCOUNT
    /**
     * @Route("/register-fan", name="app_register_fan")
     */
    public function app_register_fan(Request $request, UserAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler)
    {
        $datas = $request->request->all();

// // Verify if Username and Email already exists and return an error message
//     $repository = $this->getDoctrine()->getRepository(User::class);
//     $users = $repository->findBy(['username' => $datas['username']]);
//       $is_yet = false;
//         foreach ($users as $user) {
//             if ($user->getUsername() == $datas['username']) {
//                 $is_yet = true;
//             }
//         }

//         if ($is_yet == true) {//If the username exists already
//             return $this->redirectToRoute('app_register_fan_form', ['err' => 'y']);
//         }

        $user = new User;
        $user->setName($datas['name']);
        $user->setUsername($datas['username']);
        $user->setRoles(["ROLE_FAN"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $datas['pass2']
        ));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // User Authentication
        $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main'
        );
        return $this->redirectToRoute('look_up');

    }



    
    #[Route('/verify-username', name: 'app_verify_username')]
    public function verify_username(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomebootController.php',
        ]);
    }


}
