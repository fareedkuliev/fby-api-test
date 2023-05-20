<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\ProjectMilestones;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectMilestonesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project1 = $manager->getRepository(Project::class)->find(1);
        $project2 = $manager->getRepository(Project::class)->find(2);
        $project3 = $manager->getRepository(Project::class)->find(3);
        $project4 = $manager->getRepository(Project::class)->find(4);
        $project5 = $manager->getRepository(Project::class)->find(5);
        $project6 = $manager->getRepository(Project::class)->find(6);


        $projectMilestone1 = new ProjectMilestones();
        $projectMilestone1->setProject($project1)
                        ->setTitle('Creating business plan')
                        ->setDescription('Project Demands, Goals, Ways to Implementation')
                        ->setMilestoneDeadline(new \DateTime('2023-12-18 12:00:00'));

        $manager->persist($projectMilestone1);

        $projectMilestone2 = new ProjectMilestones();
        $projectMilestone2->setProject($project1)
            ->setTitle('Making design')
            ->setDescription('Creating templates for frontend and backend according to demands')
            ->setMilestoneDeadline(new \DateTime('2024-01-18 12:00:00'));

        $manager->persist($projectMilestone2);

        $projectMilestone3= new ProjectMilestones();
        $projectMilestone3->setProject($project2)
            ->setTitle('Making frontend part')
            ->setDescription('Creating all pages according to design templates')
            ->setMilestoneDeadline(new \DateTime('2023-12-18 12:00:00') );

        $manager->persist($projectMilestone3);

        $projectMilestone4 = new ProjectMilestones();
        $projectMilestone4->setProject($project2)
            ->setTitle('Backend part')
            ->setDescription('Writing backend part and join it to frontend ')
            ->setMilestoneDeadline(new \DateTime('2023-02-15 12:00:00'));

        $manager->persist($projectMilestone4);

        $projectMilestone5 = new ProjectMilestones();
        $projectMilestone5->setProject($project3)
            ->setTitle('Testing')
            ->setDescription('Write testcases and testing the functionality')
            ->setMilestoneDeadline(new \DateTime('2024-02-18 12:00:00'));

        $manager->persist($projectMilestone5);


        $projectMilestone6 = new ProjectMilestones();
        $projectMilestone6->setProject($project3)
            ->setTitle('Release beta version')
            ->setDescription('Release first version for the first users test-group')
            ->setMilestoneDeadline(new \DateTime('2024-03-24 12:00:00'));

        $manager->persist($projectMilestone6);

        $projectMilestone7 = new ProjectMilestones();
        $projectMilestone7->setProject($project4)
            ->setTitle('First release')
            ->setDescription('Release first version for the first users test-group')
            ->setMilestoneDeadline(new \DateTime('2024-03-24 12:00:00'));

        $manager->persist($projectMilestone7);

        $projectMilestone8 = new ProjectMilestones();
        $projectMilestone8->setProject($project5)
            ->setTitle('Beta version release')
            ->setDescription('Release first version for the first users test-group')
            ->setMilestoneDeadline(new \DateTime('2024-03-24 12:00:00'));

        $manager->persist($projectMilestone8);

        $projectMilestone9 = new ProjectMilestones();
        $projectMilestone9->setProject($project6)
            ->setTitle('Creating business plan')
            ->setDescription('Project Demands, Goals, Ways to Implementation')
            ->setMilestoneDeadline(new \DateTime('2023-12-18 12:00:00'));

        $manager->persist($projectMilestone9);

        $projectMilestone10 = new ProjectMilestones();
        $projectMilestone10->setProject($project6)
            ->setTitle('Making design')
            ->setDescription('Creating templates for frontend and backend according to demands')
            ->setMilestoneDeadline(new \DateTime('2024-01-18 12:00:00'));

        $manager->persist($projectMilestone10);

        $manager->flush();

    }

}