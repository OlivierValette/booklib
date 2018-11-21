<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookController
 * @package App\Controller
 * @Route("/book")
 */
class BookController extends BaseController
{
    /**
     * @Route("/show/{slug}", name="book_show")
     */
    public function show(Book $book)
    {
        return $this->render('book/show.html.twig', [
            'book' => $book
        ]);
    }
}
