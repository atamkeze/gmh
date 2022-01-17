<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        $admin_yet = false;

        foreach ($users as $user) {
            if ($user->getRoles()[0] == 'ROLE_ADMIN') {
                $admin_yet = true;
            }

            if ($admin_yet == true) {
                return $this->redirectToRoute("look_up");
            }
        }

        return $this->redirectToRoute("look_up");
    }

//FORM FOR ADMIN ACTIVATION
    /**
     * @Route("/init-admin-activation", name="init_admin_activation")
     */
    public function register_admin_form(){

        return $this->render('create_accounts/base_admin_auth.html.twig');
        

    }
//FORM FOR FAN'S ACCOUNTS REGISTRATIONS
    /**
     * @Route("/register-fan-form", name="app_register_fan_form")
     */
    public function register_fan_form(){
        return $this->render('create_accounts/base_fan_auth.html.twig');
    }
//FORM FOR ARTIST'S ACCOUNTS REGISTRATIONS
     /**
     * @Route("/register-artist-form", name="app_register_artist_form")
     */
    public function register_artist_form(){
        return $this->render('create_accounts/base_artist_auth.html.twig');
    }

}
