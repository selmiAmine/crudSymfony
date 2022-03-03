<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubespritController extends AbstractController
{
    /**
     * @Route("/clubesprit", name="clubesprit")
     */
    public function index(): Response
    {
        return $this->render('clubesprit/index.html.twig', [
            'controller_name' => 'ClubespritController',
        ]);
    } /**
         * @Route("/club", name="club")
     */
    public function esprit(): Response
    {
        return $this->render('clubesprit/club.html.twig', [
            'controller_name' => 'ClubespritController',
        ]);
    }


}
