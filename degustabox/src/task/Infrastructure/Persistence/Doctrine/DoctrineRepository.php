<?php

declare(strict_types=1);

namespace App\task\Infrastructure\Persistence\Doctrine;

use App\task\Domain\Model\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function persist(Task $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush();
    }

    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}