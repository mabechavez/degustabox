<?php

declare(strict_types=1);

namespace App\task\Domain\Repository;

use App\task\Domain\Model\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): void;
    public function update(Task $task): void;
    public function getByName(string $name): ?Task;
    public function getAllTasks(): array;
}