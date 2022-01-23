<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\BrowserKit\Request;

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

    //VIEW FAN PROFILE
     /**
     * @Route("/fan-profile", name="view_fan_profile")
     */
    public function view_fan_profile(){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $fan = $repository->findAll();

        return $this->render('admin/fans/view-fan-profile.html.twig',[
            'fan' => $fan,
        ]);
    }

    
    //ADMIN PROFILE
     /**
     * @Route("/admin-profile", name="admin_profile")
     */
    public function admin_profile(){

        $repository = $this->getDoctrine()->getRepository(User::class);
        $adminProfile = $repository->findAll();

        $profile_photo = 'dec52418e92a4ee8b9234b376e546917.jpg';

        // $isSuc = false;
        // $isErr = false;

        // if($request->get('suc')){
        //     $isSuc = true;
        // }

        // if($request->get('err')){
        //     $isErr = true;
        // }

        return $this->render('admin/admin-pages/admin-profile.html.twig',[
            'adminProfile' => $adminProfile,
            'profile_photo' => $profile_photo
            // 'isSuc' =>$isSuc,
            // 'isErr' => $isErr,
        ]);
    }
}