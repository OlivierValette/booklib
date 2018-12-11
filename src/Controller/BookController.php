<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookController
 * @package App\Controller
 * @Route("/book")
 */
class BookController extends BaseController
{
    
    /**
     * @Route("/", name="book_list", methods="GET")
     */
    public function index(Request $request): Response
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        
        if ($request->isXmlHttpRequest()) {
            // if API call
            return $this->json($books);
        } else {
            // if browser
            return $this->render('book/index.html.twig', [
               'books' => $books
            ]);
        }
    }
    
    /**
     * @param $book
     * @Route("/show/{slug}", name="book_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Book $book)
    {
        $otherbooks = $this->getDoctrine()->getRepository(Book::class)
            ->findFirstsAuthorBooks($book->getAuthor(), 3, $book);
        return $this->render('book/show.html.twig', [
            'book' => $book,
            'otherbooks' => $otherbooks
        ]);
    }
}
