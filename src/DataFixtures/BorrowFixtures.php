<?php

namespace App\DataFixtures;

use App\Entity\Borrow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BorrowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $borrow = new Borrow();
            $borrow->setBook($this->getReference('book-' . $faker->numberBetween(1, 20)));
            $datestart = $faker->dateTimeThisYear('now', 'Europe/Paris');
            $borrow->setDateStart($datestart);
            $borrow->setBoxFrom($this->getReference('box-' . $faker->numberBetween(1, 99)));
            if ($faker->boolean) {
                $borrow->setBoxTo($this->getReference('box-' . $faker->numberBetween(1, 99)));
                $datend = clone $datestart;
                $datend->modify("+" . $faker->numberBetween(1, 30) . " day");
                $borrow->setDateEnd($datend);
            }
            $borrow->setUser($this->getReference('user-' . $faker->numberBetween(1, 20)));
            $manager->persist($borrow);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [UserFixtures::class, BoxFixtures::class, BookFixtures::class];
    }
}