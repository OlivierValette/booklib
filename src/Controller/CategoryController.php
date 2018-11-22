<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/category")
 */
class CategoryController extends BaseController
{
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
