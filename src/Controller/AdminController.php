<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    #[Route('/admin-dashboard', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    
//LIST OF FANS ACCOUNTS
     /**
     * @Route("/list-fans", name="app_list_fans")
     */
    public function list_fans(){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $fans = $repository->findAll();

        return $this->render('admin/fans/list-fans.html.twig', [
            'fans' => $fans,
        ]);
    }
//LIST OF ARTISTS ACCOUNTS
     /**
     * @Route("/list-artists", name="app_list_artists")
     */
    public function list_artists(){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $artists = $repository->findAll();

        return $this->render('admin/artists/list-artists.html.twig',[
            'artists' => $artists,
        ]);
    }
}
