<?php

declare(strict_types=1);

namespace App\UI;

use App\task\Application\Service\TaskServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends AbstractController {
    private $taskService;

    public function __construct(TaskServiceInterface $taskService) {
        $this->taskService = $taskService;
    }

    #[Route('/check-task', name: 'check_task', methods: ['POST'])]
    public function checkTask(Request $request): Response {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];

        try {
            $totalTime = $data['totalTime'];
            $status = $data['status'];
            $this->taskService->updateTask($name, $totalTime, new \DateTime(), $status);

            return new Response('Task updated successfully', 200);
        } catch (\Exception $e) {
            // Si la tarea no existe, crea una nueva
            $this->taskService->createTask($name, new \DateTime());

            return new Response('Task created successfully', 201);
        }
    }
}
