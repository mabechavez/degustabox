<?php

declare(strict_types=1);

namespace App\UI;

use App\task\Application\Service\TaskServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends AbstractController {
    private $taskService;

    public function __construct(TaskServiceInterface $taskService) {
        $this->taskService = $taskService;
    }

    #[Route('/check-task', name: 'check_task', methods: ['POST'])]
    public function checkTask(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];

        if($this->taskService->checkTask($name)){
            $totalTime = $data['totalTime'];
            $status = $data['totalTime'] ? 'stopped' : 'started';
            $this->taskService->updateTask($name, $totalTime, new \DateTime(), $status);

            return new JsonResponse('Task updated successfully', 200);
        }else{
            $this->taskService->createTask($name, new \DateTime());

            return new JsonResponse('Task created successfully', 201);
        }
    }
}
