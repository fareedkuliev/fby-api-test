<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectMilestones;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectMilestonesController extends AbstractController
{
    #[Route('/api/milestones/{project_id}', name: 'get_project_milestone', methods: 'GET')]
    public function getMilestone(ManagerRegistry $doctrine, int $project_id): JsonResponse
    {
        $em = $doctrine->getManager();
        $milestones = $em->getRepository(ProjectMilestones::class)->findBy(['project' => $project_id]);

        $allMilestones = [];

        foreach($milestones as $milestone){
            $allMilestones[] = [
                'id' => $milestone->getId(),
                'project' => $milestone->getProject()->getId(),
                'title' => $milestone->getTitle(),
                'description' => $milestone->getDescription(),
                'milestone_deadline' => $milestone->getMilestoneDeadline()
            ];
        }

        return $this->json($allMilestones);
    }

    #[Route('/api/milestone', name: 'add_project_milestone', methods: 'POST')]
    public function addMilestone(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $em = $doctrine->getManager();

        $data = json_decode($request->getContent(), true);

        if($data['project_id'] === '' || $data['title'] === '' || $data['description'] === '' || empty($data['deadline'])){
            $response = [
                'success' => false,
                'message' => 'Empty data',
            ];
            return $this->json($response, 400);
        }

        $project = $em->getRepository(Project::class)->find($data['project_id']);

        $milestone = new ProjectMilestones();
        $milestone->setProject($project)
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setMilestoneDeadline(new \DateTime($data['deadline']));


        $em->persist($milestone);
        $em->flush();


        return $this->json([
            'status' => true,
            'message' => 'Milestone has successfully been added',
        ], 201);
    }

    #[Route('/api/milestone/delete/{id}', name: 'delete_project_milestone', methods: 'DELETE')]
    public function deleteMilestone(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $em = $doctrine->getManager();
        $milestone = $em->getRepository(ProjectMilestones::class)->find($id);

        if (!$milestone) {
            return $this->json([
                'success' => false,
                'message' => 'Milestone not fount'
            ] , 404);
        }

        $em->remove($milestone);
        $em->flush();

        return $this->json([
            'status' => true,
            'message' => 'Milestone has been successfully deleted',
        ]);
    }
}
