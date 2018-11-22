<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $authors = [
            ["J.K.", "Rowling"],
            ["René", "Goscinny"],
            ["Gustave", "Flaubert"],
            ["Emile", "Zola"],
        ];
        foreach ($authors as $key => $author) {
            $aut = new Author();
            $aut->setFirstname($author[0]);
            $aut->setLastname($author[1]);
            $manager->persist($aut);
            $this->setReference('author-' . ($key + 1), $aut);
        }
        $faker = Factory::create('fr_FR');
        for($i = 5; $i < 100; $i++) {
            $faker->seed($i);
            $author = new Author();
            $author->setFirstname($faker->firstName);
            $author->setLastname($faker->lastName);
            $manager->persist($author);
            $this->setReference('author-' . $i, $author);
        }
        $manager->flush();
    }
}
