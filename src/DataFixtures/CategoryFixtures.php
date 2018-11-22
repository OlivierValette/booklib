<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ["Roman", "SF", "BD"];
        foreach ($categories as $key => $category) {
            $cat = new Category();
            $cat->setName($category);
            $manager->persist($cat);
            $this->setReference('category-' . ($key + 1), $cat);
        }
        $manager->flush();
    }
}
