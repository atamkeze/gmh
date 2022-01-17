<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_USER")
 * @Route("/app")
 */
class GlobalAnonymousController extends AbstractController
{
    #[Route('/', name: 'global_anonymous')]
    public function index(): Response
    {
        return $this->render('global_anonymous/index.html.twig', [
            'controller_name' => 'GlobalAnonymousController',
        ]);
    }
}
