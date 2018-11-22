<?php

namespace App\DataFixtures;

use App\Entity\Box;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BoxFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $faker->seed($i);
            $box = new Box();
            $box->setCity($faker->city);
            $box->setAddress($faker->address);
            $box->setZipCode($faker->postcode);
            $box->setLatitude($faker->latitude);
            $box->setLongitude($faker->longitude);
            $box->setComment($faker->paragraph);
            $manager->persist($box);
            $this->addReference('box-' . $i, $box);
        }
        $manager->flush();
    }
}