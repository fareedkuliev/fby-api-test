<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/users/{id}', name: 'get_user', methods: 'GET')]
    public function getUserById(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $em = $doctrine->getManager();

        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            return $this->json([
                'success' => false,
                'message' => 'User not fount'
            ] , 404);
        }

        $userData = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
            ];

        return $this->json($userData);

    }

    #[Route('/api/users', name: 'app_user', methods: 'GET')]
    public function getUsers(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $em = $doctrine->getManager();

        $users = $em->getRepository(User::class)->findAll();

        $allUsers = [];
        foreach ($users as $user) {
          $projectsNumber = count($em->getRepository(Project::class)->findBy(['user' => $user->getId()]));
            $allUsers[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'numberOfProjects' => $projectsNumber
            ];
        }

        return $this->json($allUsers);
    }

    #[Route('/api/user/delete/{id}', name: 'delete_user', methods: 'DELETE')]
    public function deleteUser(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $em = $doctrine->getManager();
        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->find($id);

        if (!$user) {
            return $this->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        foreach ($user->getProjects() as $project) {
            foreach ($project->getProjectMilestones() as $milestone) {
                $em->remove($milestone);
            }
            $em->remove($project);
        }

        $em->remove($user);
        $em->flush();

        return $this->json([
            'success' => true,
            'message' => 'User, associated projects, and project milestones have been successfully deleted'
        ], 201);
    }
}
