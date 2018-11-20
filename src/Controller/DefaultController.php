<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/default/{lastname}", name="default")
     */
    public function index(string $lastname)
    {
        $author = $this->getDoctrine()
            ->getRepository(Author::class)
            ->findOneBy(['lastname' => $lastname]);
        
        if($author) {
            return new Response($author->getFirstname() . $author->getLastname());
        } else {
            return new Response('404 - Not found');
        }
    }
}
