<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/', name: 'new_author', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $author = new Author();
        $author->setName($parameters["name"]);

        $em->persist($author);
        $em->flush();
        return $this->json([
            'message' => 'Author saved',
        ]);
    }

    #[Route('/', name:'get_author', methods: ['GET'])]
    public function getAll(AuthorRepository $authorRepository): JsonResponse
    {

        $authors = $authorRepository->findAll();

         return $this->json($authors);
    }
}
