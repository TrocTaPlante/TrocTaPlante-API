<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $roles = ["USER", "MODERATOR", "ADMIN", "SUPERADMIN"];

        foreach ($roles as $index => $role){
            $hash = password_hash($role, PASSWORD_BCRYPT);

            $user = new User();
            $user->setEmail($role."@gmail.com");
            $user->setRoles([$role]);
            $user->setPassword($hash);
            $user->setFirstName($role);
            $user->setLastName($role);
            $user->setStreetNumber($index);
            $user->setCity("Ville du ".$role);
            $user->setZipCode("76000");
            $user->setStreetName("Rue du ".$role);
            $user->setLatitude(0);
            $user->setLongitude(0);
            $user->setPhone("0600000000");
            $user->setUsername($role);
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        //Indique dans quel ordre les fixtures doivent être chargées
        return 1;
    }
}