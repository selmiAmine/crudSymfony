<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    /**
     * @Route("/listclassrooms", name="listclassrooms")
     */
    public function listclassrooms(): Response
    {

        $rep=$this->getDoctrine()->getRepository(classroom::class);
        $classrooms=$rep->findAll();

        return $this->render('classroom/listclassrooms.html.twig', [
            'listclassrooms' => $classrooms,
        ]);
    }

    /**
     * @Route("/addclassroom", name="addclassroom")
     */
    public function add(Request $request): Response
    {
        $em =$this->getDoctrine()->getManager();
        $classroom=new Classroom();
        $form = $this->createForm(ClassroomType::class,$classroom);
        $form->add('add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $classroom=$form->getData();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('listclassrooms');
        }

        return $this->render('classroom/add.html.twig', [ 'formC'=>$form->createView()
        ]);
    }

    /**
     * @Route("/deleteclassroom/{id}", name="deleteclassroom")
     */
    public function delete($id): Response
    {
        $rep=$this->getDoctrine()->getRepository(classroom::class);
        $em=$this->getDoctrine()->getManager();
        $classroom=$rep->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('listclassrooms');
    }

    /**
     * @Route("/updateclassroom/{id}", name="updateclassroom")
     */
    public function update(Request $request,$id): Response
    {
        $em =$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository(classroom::class);
        $classroom=$rep->find($id);
        $form = $this->createForm(ClassroomType::class,$classroom);
        //$form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $classroom=$form->getData();
            $em->flush();
            return $this->redirectToRoute('listclassrooms');
        }

        return $this->render('classroom/update.html.twig', [ 'formU'=>$form->createView()
        ]);

    }
}
