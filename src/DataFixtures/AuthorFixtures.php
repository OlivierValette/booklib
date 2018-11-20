<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $authors = [
            ["Austin", "Jane"],
            ["Hugo", "Victor"],
            ["Camus", "Albert"],
            ["Vian", "Boris"],
            ["Rowling", "J.K."],
            ["Goscinny", "René"],
            ["Flaubert", "Gustave"],
            ["Zola", "Emile"],
            ];
    
        foreach ($authors as $author) {
            $aut = new Author();
            $aut->setLastname($author[0]);
            $aut->setFirstname($author[1]);
            $manager->persist($aut);
            // reference for dependencies
            $this->setReference(strtolower($author[0]), $aut);
        }

        $manager->flush();
    }
}
