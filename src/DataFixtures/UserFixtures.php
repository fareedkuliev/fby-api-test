<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('johdoe45@gmail.com')
            ->setEnabled(true)
            ->setStatus('active');

        $manager->persist($user1);

        $user2 = new User();
        $user2->setFirstName('David')
            ->setLastName('Backham')
            ->setEmail('davidbacks99@gmail.com')
            ->setEnabled(true)
            ->setStatus('active');

        $manager->persist($user2);

        $user3 = new User();
        $user3->setFirstName('Ivan')
            ->setLastName('Drago')
            ->setEmail('boxernumber1@gmail.com')
            ->setEnabled(true)
            ->setStatus('suspend');

        $manager->persist($user3);

        $user4 = new User();
        $user4->setFirstName('Yuri')
            ->setLastName('Dud')
            ->setEmail('dud777@gmail.com')
            ->setEnabled(false)
            ->setStatus('inactive');

        $manager->persist($user4);

        $user5 = new User();
        $user5->setFirstName('Joe')
            ->setLastName('Biden')
            ->setEmail('potus@gmail.com')
            ->setEnabled(true)
            ->setStatus('active');

        $manager->persist($user5);

        $user6 = new User();
        $user6->setFirstName('Rocky')
            ->setLastName('Balboa')
            ->setEmail('boxernumber2@gmail.com')
            ->setEnabled(true)
            ->setStatus('active');

        $manager->persist($user6);

//        $manager->flush();
    }
}