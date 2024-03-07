<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\TaskType;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class TaskController extends AbstractController
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    #[Route('/', name: 'app_tasks')]
    public function allTasks(): Response
    {
        return $this->render('task/tasks.html.twig', [
            'tasks' => $this->taskRepository->findAll(),
        ]);
    }

    #[Route('/task/add', name: 'app_task_add')]
    public function addTask(Request $request, EntityManagerInterface $em): Response
    {
        $msg = "";
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->persist($task);
            $em->flush();
            $msg = 'La nouvelle tache a bien été ajoutée.';
        }
        return $this->render('task/index.html.twig', [
            'form' => $form->createView(),
            'msg'=> $msg,
        ]);
    }
}
