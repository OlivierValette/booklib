<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findLast(6);
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy([], ['name' => 'ASC']);
        
        return $this->render('default/homepage.html.twig', [
            "books" => $books,
            "categories" => $categories,
            ]);
    }
    
    /**
     * @Route("/default/{lastname}", name="default")
     */
    public function index(string $lastname, Request $request)
    {
        $author = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findOneBy(['lastname' => $lastname]);
        
        // echo $request->query->get('test');
        
        if($author) {
            return $this->render("default/index.html.twig", ["author" => $author]);
        } else {
            throw $this->createNotFoundException("Auteur introuvable.");
        }
    }
    
    /**
     * @Route("/default/book/{id}", name="show-book")
     */
    public function showBook(Book $book)
    {
        return new Response($book->getTitle());
    }
}
