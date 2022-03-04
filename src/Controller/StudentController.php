<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('student/test.html.twig', [
            'name' => 'hey',
            'mail'=>'khiari.hey@esprit.tn'
        ]);
    }
    /**
    * @Route("/msg")
    */
    public function studentmsg()
    {
        return new Response("Hello");
    }

    public function hello ()
    {
        return new Response("have a nice day my student");
    }

    /**
     * @Route("/listStudents", name="listStudents")
     */
    public function listStudents() : Response{
        $rep=$this->getDoctrine()->getRepository(Student::class);
        $students=$rep->findAll();
        return $this->render('student/listStudents.html.twig', [
            'listStudents' => $students,
        ]);
    }

    /**
     * @Route("/addStudent", name="addStudent")
     */
    public function add(Request $request):Response{
        $em =$this->getDoctrine()->getManager();
        $student=new Student();
        $form = $this->createForm(StudentType::class,$student);
        $form->add('add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $classroom=$form->getData();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('listStudents');
        }

        return $this->render('student/add.html.twig', [ 'formS'=>$form->createView()
        ]);
    }
    /**
     * @Route("/deleteStudent/{id}", name="deleteStudent")
     */
    public function delete($id){
        $rep=$this->getDoctrine()->getRepository(student::class);
        $em=$this->getDoctrine()->getManager();
        $student=$rep->find($id);
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('listStudents');
    }



    /**
     * @Route("/updateStudent/{id}", name="updateStudent")
     */
    public function update(Request $request,$id):Response {
        $em =$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository(student::class);
        $students=$rep->find($id);
        $form = $this->createForm(StudentType::class,$students);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $students=$form->getData();
            $em->flush();
            return $this->redirectToRoute('listStudents');
        }
        return $this->render('student/update.html.twig', [ 'formU'=>$form->createView()
        ]);

    }

}
