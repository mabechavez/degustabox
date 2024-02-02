<?php

declare(strict_types=1);

namespace App\task\Application\Service;

use App\task\Domain\Model\Task;

interface TaskServiceInterface {
    public function createTask(string $name, \DateTimeInterface $startDate): Task;
    public function updateTask(string $name, int $totalTime, \DateTimeInterface $endDate, string $status): Task;
    public function checkTask(string $name): bool;
}
