<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectMilestones;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/api/projects', name: 'app_project', methods: 'GET')]
    public function getProjects(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $em = $doctrine->getManager();

        $repository = $em->getRepository(Project::class);

        $projects = ($user_id = $request->get('user_id'))
            ? $repository->findBy(['user' => $user_id])
            : $repository->findAll();

        $allProjects = [];

        foreach($projects as $project){
            $allProjects[] = [
                'id' => $project->getId(),
                'user_id' =>$project->getUser()->getId(),
                'title' => $project->getTitle(),
                'description' => $project->getDescription()
            ];
        }

        return $this->json($allProjects);
    }

    #[Route('/api/project', name: 'post_project', methods: 'POST')]
    public function addProject(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $em = $doctrine->getManager();

        $data = json_decode($request->getContent(), true);

        if ($data['user_id'] === '' || $data['title'] === '' || $data['description'] === '') {
            $response = [
                'success' => false,
                'message' => 'Empty data',
            ];
            return $this->json($response, 400);
        }

        $user = $em->getRepository(User::class)->find($data['user_id']);

        $project = new Project();
        $project->setUser($user)
                ->setTitle($data['title'])
                ->setDescription($data['description']);

        $em->persist($project);
        $em->flush();

        return $this->json([
            'success' => true,
            'message' => 'Project has successfully been added',
        ], 201);
    }

    #[Route('/api/project/delete/{id}', name: 'delete_project', methods: 'DELETE')]
    public function deleteProject(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $em = $doctrine->getManager();
        $project = $em->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->json([
                'success' => false,
                'message' => 'Project not fount'
            ] , 404);
        }

        $projectMilestones = $em->getRepository(ProjectMilestones::class)->findBy(['project' => $project->getId()]);

        $em->remove($project);
        foreach($projectMilestones as $milestone){
            $em->remove($milestone);
        }
        $em->flush();

        return $this->json([
            'success' => true,
            'message' => 'Project and his milestones has successfully been deleted'
        ], 201);
    }
}
