<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * 
 * @IsGranted("ROLE_USER")
 */
class LookUpController extends AbstractController
{
    #[Route('/look-up', name: 'look_up')]
    public function index(): Response
    {
        if ($this->getUser()->getRoles()[0] == 'ROLE_ADMIN') {
            return $this->redirectToRoute('admin');
       }

       if ($this->getUser()->getRoles()[0] == 'ROLE_ARTIST') {
           return $this->redirectToRoute('artist');
       }
       if ($this->getUser()->getRoles()[0] == 'ROLE_FAN') {
           return $this->redirectToRoute('fan');
       }

        return $this->render('look_up/index.html.twig', [
            'controller_name' => 'LookUpController',
        ]);
    }

    
}
