<?php

declare(strict_types=1);

namespace App\task\Infrastructure\Persistence;

use App\task\Domain\Model\Task;
use App\task\Domain\Repository\TaskRepositoryInterface;
use App\task\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class InMemoryTaskRepository extends DoctrineRepository implements TaskRepositoryInterface {

    public function save(Task $task): void {
        $this->persist($task);
    }

    public function update(Task $task): void {
        $this->persist($task);
    }

    public function getByName(string $name): ?Task {
        return $this->repository(Task::class)->findOneBy(['name' => $name]);
    }

    public function getAllTasks(): array {
        return $this->repository(Task::class)->findAll();
    }
}
