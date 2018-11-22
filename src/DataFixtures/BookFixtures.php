<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $hp_cpdf = new Book();
        $hp_cpdf->setTitle("Harry Potter et la coupe de feu");
        $hp_cpdf->setAuthor($this->getReference('author-1'));
        $hp_cpdf->addCategory($this->getReference('category-1'));
        $hp_cpdf->addCategory($this->getReference('category-2'));
        $hp_cpdf->setImage('hpelcdf.jpg');
        $hp_cpdf->setSlug('harry-potter-et-la-coupe-de-feu');
        $manager->persist($hp_cpdf);
        $this->addReference('book-1', $hp_cpdf);
        $aec = new Book();
        $aec->setTitle("Astérix et Cléopâtre");
        $aec->setAuthor($this->getReference('author-2'));
        $aec->addCategory($this->getReference('category-3'));
        $aec->setImage('aec.jpg');
        $aec->setSlug('asterix-et-cleopatre');
        $manager->persist($aec);
        $this->addReference('book-2', $aec);
        $mb = new Book();
        $mb->setTitle("Madame Bovary");
        $mb->setAuthor($this->getReference('author-3'));
        $mb->addCategory($this->getReference('category-1'));
        $mb->setImage('mb.jpg');
        $mb->setSlug('madame-bovary');
        $manager->persist($mb);
        $this->addReference('book-3', $mb);
        $hpalds = new Book();
        $hpalds->setTitle("Harry Potter à l'école des sorciers");
        $hpalds->setAuthor($this->getReference('author-1'));
        $hpalds->addCategory($this->getReference('category-1'));
        $hpalds->addCategory($this->getReference('category-2'));
        $hpalds->setImage('hpalds.jpg');
        $hpalds->setSlug('harry-potter-a-l-ecole-des-sorciers');
        $manager->persist($hpalds);
        $this->addReference('book-4', $hpalds);
        $faker = Factory::create('fr_FR');
        for($i = 5; $i <= 20; $i++) {
            $faker->seed($i);
            $book = new Book();
            $book->setTitle($faker->sentence(5));
            $book->setAuthor($this->getReference('author-' . $faker->numberBetween(5, 99)));
            $max = $faker->numberBetween(1, 5);
            for ($j = 1; $j < $max; $j++) {
                $book->addCategory($this->getReference('category-' . $faker->numberBetween(1, 3)));
            }
            $upload_dir = __DIR__ . '/../../public/uploads/';
            $filename = "book-" . $i . ".jpg";
            if (!file_exists($upload_dir . $filename)) {
                $image = $faker->image($upload_dir, 300, 300, null, false);
                rename($upload_dir . $image, $upload_dir . $filename);
            }
            $book->setImage($filename);
            $book->setSlug($faker->slug);
            $manager->persist($book);
            $this->addReference('book-' . $i, $book);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [CategoryFixtures::class, AuthorFixtures::class];
    }
}