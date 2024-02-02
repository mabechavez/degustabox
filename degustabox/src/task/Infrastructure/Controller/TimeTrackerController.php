<?php
declare(strict_types=1);

namespace App\task\Infrastructure\Controller;

use App\task\Infrastructure\Persistence\InMemoryTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TimeTrackerController extends AbstractController
{
    private $taskRepository;

    public function __construct(InMemoryTaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    #[Route('/')]
    public function index(): Response
    {
        $tasks = $this->taskRepository->getAllTasks();
        return $this->render('timeTracker/index.html.twig', [
            'tasks' => $tasks
        ]);
    }
}