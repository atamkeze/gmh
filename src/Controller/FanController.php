<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_FAN")
 * @Route("/fan")
 */

class FanController extends AbstractController
{
    #[Route('/fan-home', name: 'fan')]
    public function index(): Response
    {
        return $this->render('fan/index.html.twig', [
            'controller_name' => 'FanController',
        ]);
    }
}
