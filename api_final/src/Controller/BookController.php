<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('/', name: 'new_book', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $author = $em->getRepository(Author::class)->find($parameters['author']);

        $book = new Book();
        $book->setTitle($parameters["title"]);
        $book->setDescription($parameters["description"]);
        $book->setNumberPages($parameters["numberPages"]);
        $book->setAuthor($author);

        $em->persist($book);
        $em->flush();
        return $this->json([
            'message' => 'Book saved!',
        ]);
    }

    #[Route('/', name:'get_book', methods: ['GET'])]
    public function getAll(BookRepository $bookRepository): JsonResponse
    {

        $books = $bookRepository->findAll();
        return $this->json($books);
    }
    
    #[Route('/{id}', name:'edit_book', methods: ['PUT'])]
    public function edit(Request $request, EntityManagerInterface $em, Book $book): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $author = $em->getRepository(Author::class)->find($parameters['author']);

        $book->setTitle($parameters["title"]);
        $book->setDescription($parameters["description"]);
        $book->setNumberPages($parameters["numberPages"]);
        $book->setAuthor($author);

        $em->persist($book);
        $em->flush();
        return $this->json([
            'message' => 'Book edited!',
        ]);
    }

    #[Route('/{id}', name:'delete_book', methods: ['DELETE'])]
    public function delete(Request $request, EntityManagerInterface $em, ?Book $book): JsonResponse
    {
        if ($book) {
            $em->remove($book);
            $em->flush();
            return $this->json([
                'message' => 'Book deleted!',
            ]);
        }

        return $this->json([
            'message'=> 'Book already deleted!',
        ]);
        
    }

}
