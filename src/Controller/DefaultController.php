<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("/default")
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/{lastname}", name="default")
     */
    public function index(string $lastname, Request $request)
    {
        $author = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findOneBy(['lastname' => $lastname]);
        
        echo $request->query->get('test');
        
        if($author) {
            return $this->render("default/index.html.twig", ["author" => $author]);
        } else {
            throw $this->createNotFoundException("Auteur introuvable.");
        }
    }
    
    /**
     * @Route("/book/{id}", name="show-book")
     */
    public function showBook(Book $book)
    {
        return new Response($book->getTitle());
    }
}
