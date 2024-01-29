<?php

namespace App\Controller;

use App\Entity\School;
use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/students')]
class StudentController extends AbstractController
{
    #[Route('/', name: 'new_student', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $school = $em->getRepository(School::class)->find($parameters['school']);

        $student = new Student();
        $student->setName($parameters['name']);
        $student->setDescription($parameters['description']);
        $student->setAge($parameters['age']);
        $student->setSchool($school);

        $em->persist($student);
        $em->flush();
        return $this->json([
            'message' => 'Student saved!'
        ]);
    }

    #[Route('/', name:'get_students', methods: ['GET'])]
    public function getAll(StudentRepository $studentRepository): JsonResponse
    {
        $students = $studentRepository->findAll();
        return $this->json($students);
    }

    #[Route('/{id}', name:'edit_students', methods: ['PUT'])]
    public function edit(Request $request, EntityManagerInterface $em, Student $student): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $school = $em->getRepository(School::class)->find($parameters['school']);

        $student->setName($parameters['name']);
        $student->setDescription($parameters['description']);
        $student->setAge($parameters['age']);
        $student->setSchool($school);

        $em->persist($student);
        $em->flush();
        return $this->json([
            'message' => 'Student edited!',
        ]);
    }

    #[Route('/{id}', name:'delete_student', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, ?Student $student): JsonResponse
    {
        if ($student) {
            $em->remove($student);
            $em->flush();
            return $this->json([
                'message' => 'Student deleted!',
            ]);
        }

        return $this->json([
            'message'=> 'Student already deleted!',
        ]);
        
    }
}
