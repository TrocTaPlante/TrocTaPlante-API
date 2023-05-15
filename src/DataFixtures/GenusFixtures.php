<?php

namespace App\DataFixtures;

use App\Entity\Genus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GenusFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $genusPlante = new Genus();
        $genusPlante->setName("Plante");
        $manager->persist($genusPlante);

        $genusSeed = new Genus();
        $genusSeed->setName("Graine");
        $manager->persist($genusSeed);

        $manager->flush();
    }

    public function getOrder()
    {
        //Indique dans quel ordre les fixtures doivent être chargées
        return 2;
    }
}