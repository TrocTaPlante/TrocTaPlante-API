<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\GenusRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements OrderedFixtureInterface
{
    private GenusRepository $genusRepository;
    private UserRepository $userRepository;

    public function __construct(GenusRepository $genusRepository, UserRepository $userRepository)
    {
        $this->genusRepository = $genusRepository;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        //Crée 100 produits dans la base de données
        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->setQuantity(rand(1, 100));
            $product->setGenus($this->genusRepository->findOneBy(["id" => rand(1, 2)]));
            $product->setState("Bon Etat");
            $product->setHeight(rand(1, 100));
            $product->setPotHeight(rand(1, 100));
            $product->setPotWidth(rand(1, 100));
            $product->setSpecies("Produit " . $i);
            $product->setUser($this->userRepository->findOneBy(["id" => rand(1, 4)]));
            $product->setCreatedAt(new \DateTimeImmutable());
            $product->setUpdatedAt(new \DateTimeImmutable());
            $product->setLongitude("2.3488" . $i);
            $product->setLatitude("48.8534" . $i);
            $product->setPostStatus("ONLINE");
            $product->setDescription("Description du produit " . $i);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        //Indique dans quel ordre les fixtures doivent être chargées
        return 3;
    }
}
