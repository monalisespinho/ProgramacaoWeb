<?php

namespace App\Controller;

use App\Entity\School;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/schools")]
class SchoolController extends AbstractController
{
    #[Route('/', name: 'new_school', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {   
        $parameters = json_decode($request->getContent(), true);
        $school = new School();
        $school->setName($parameters['name']);

        $em->persist($school);
        $em->flush();

        return $this->json([
            'message' => 'School saved!',
        ]);
    }

    #[Route('/', name:'get_schools', methods: ['GET'])]
    public function getAll(SchoolRepository $schoolRepository): JsonResponse
    {
        $schools = $schoolRepository->findAll();
        return $this->json($schools);
    }
}
