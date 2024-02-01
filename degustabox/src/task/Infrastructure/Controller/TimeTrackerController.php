<?php
declare(strict_types=1);

namespace App\task\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TimeTrackerController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('timeTracker/create_update_task.html.twig', [
        ]);
    }
}