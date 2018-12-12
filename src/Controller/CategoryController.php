<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/category")
 */

class CategoryController extends BaseController
{
    
    /**
     * @Route("/", name="category_list", methods="GET")
     */
    public function index(Request $request): Response
    {
        // request with array output for json API
        // (to avoid serialization problems)
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult();
        
        if ($request->isXmlHttpRequest()) {
            return $this->json($categories);
        }
        return new Response('html');
    }
    
    /**
     * @Route("/show/{id}", name="category_show")
     */
    public function show(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
    
    public function dropDown()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->findBy([], ['name' => 'ASC']);
        return $this->render('category/dropdown.html.twig', ['categories' => $categories]);
    }
}
