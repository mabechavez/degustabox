<?php

declare(strict_types=1);

namespace App\task\Domain\Model;

class Task {
    private $id;
    private $name;
    private $startDate;
    private $endDate;
    private $totalTime;
    private $status;

    const STATUS_STARTED = 'started';
    const STATUS_STOPED = 'stoped';

    public function __construct(string $name, int $totalTime, \DateTimeInterface $startDate, \DateTimeInterface $endDate, string $status) {
        $this->id = uniqid();
        $this->name = $name;
        $this->totalTime = $totalTime;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function update(Task $task): void {
        $this->name = $task->getName();
        $this->startDate = $task->getStartDate();
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getTotalTime(): int {
        return $this->totalTime;
    }

    public function getStartDate(): \DateTimeInterface {
        return $this->startDate;
    }

    public function getEndDate(): \DateTimeInterface {
        return $this->endDate;
    }
}