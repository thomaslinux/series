<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $serie = new Serie();
            $serie
                ->setBackdrop('backdrop.png')
                ->setDateCreated(new \DateTime())
                ->setFirstAirDate($faker->dateTimeBetween('-5 year'))
                ->setName($faker->text(20))
                ->setGenres($faker->randomElement(['SF', 'Comedy', 'Drama', 'Western']));
            $serie->setLastAirDate($faker->dateTimeBetween($serie->getFirstAirDate()))
                ->setPopularity(5000)
                ->setPoster('poster.png')
                ->setStatus('canceled')
                ->setTmdbId(12345)
                ->setVote(8);
        }
    }
}
