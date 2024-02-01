<?php

declare(strict_types=1);

namespace App\task\Application\create;

use App\task\Domain\Model\Task;
use App\task\Domain\Repository\TaskRepositoryInterface;

final readonly class TaskCreator
{
    public function __construct(private TaskRepositoryInterface $repository) {}

    public function create(string $name, int $totalTime, \DateTimeInterface $startDate, \DateTimeInterface $endDate, string $status): void
    {
        $this->repository->save(new Task($name, $totalTime, $startDate, $endDate, $status));
    }
}