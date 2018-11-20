<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $book = new Book();
        $book->setTitle("Harry Potter et la coupe de feu");
        $book->setAuthor($this->getReference('rowling'));
        $book->addCategory($this->getReference('roman'));
        $book->addCategory($this->getReference('fantastique'));
        $book->setImage('hpelcdf.jpg');
        $book->setSlug('harry-potter-et-la-coupe-de-feu');
        $manager->persist($book);

        $manager->flush();
    }
    
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class, AuthorFixtures::class];
    }
}
