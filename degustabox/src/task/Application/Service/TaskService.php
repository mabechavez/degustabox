<?php

declare(strict_types=1);

namespace App\task\Application\Service;

use App\task\Domain\Model\Task;
use App\task\Infrastructure\Persistence\InMemoryTaskRepository;

class TaskService implements TaskServiceInterface {
    private $taskRepository;

    public function __construct(InMemoryTaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(string $name, \DateTimeInterface $startDate): Task {
        $task = new Task($name, 0, $startDate, $startDate, 'started');
        $this->taskRepository->save($task);
        return $task;
    }

    public function updateTask(string $name, int $totalTime, \DateTimeInterface $endDate, string $status): Task {
        $existingTask = $this->taskRepository->getByName($name);

        if ($existingTask) {
            $existingTask->update($totalTime+$existingTask->getTotalTime(), $endDate, $status);
            $this->taskRepository->update($existingTask);
        }
        return $existingTask;
    }

    public function checkTask(string $name): bool {
        $existingTask = $this->taskRepository->getByName($name);

        return (bool)$existingTask;
    }

    public function getAllTasks(): ?array {

        return $this->taskRepository->getAllTasks();
    }
}
