<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = $manager->getRepository(User::class)->find(1);
        $user2 = $manager->getRepository(User::class)->find(2);
        $user3 = $manager->getRepository(User::class)->find(3);
        $user4 = $manager->getRepository(User::class)->find(4);
        $user5 = $manager->getRepository(User::class)->find(5);
        $user6 = $manager->getRepository(User::class)->find(6);

        $project1 = new Project();
        $project1->setUser($user1)
            ->setTitle('Banking app')
            ->setDescription('Banking app for mobile and desktop users');

        $manager->persist($project1);

        $project2 = new Project();
        $project2->setUser($user1)
            ->setTitle('E-commerce')
            ->setDescription('Internet store for selling supplies');

        $manager->persist($project2);

        $project3 = new Project();
        $project3->setUser($user2)
            ->setTitle('E-commerce')
            ->setDescription('E-device store web-site');

        $manager->persist($project3);

        $project4 = new Project();
        $project4->setUser($user2)
            ->setTitle('Dating app')
            ->setDescription('For new acquaintance and dating ');

        $manager->persist($project4);

        $project5 = new Project();
        $project5->setUser($user3)
            ->setTitle('Automobile app')
            ->setDescription('For car system managing');

        $manager->persist($project5);

        $project6 = new Project();
        $project6->setUser($user6)
            ->setTitle('Mobile broker')
            ->setDescription('For sale and buy shares, options, futures');

        $manager->persist($project6);

//        $manager->flush();
    }

}