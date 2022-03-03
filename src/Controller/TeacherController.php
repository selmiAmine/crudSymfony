<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="teacher")
     */
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }
    /**
     * @Route("/st/{name}", name="teacher")
     */
    public function ShowTeacher($name): Response
    {
        return $this->render('teacher/showteacher.html.twig', ['nom'=>$name, 'p' => "Bonjour"]);
    }
}
