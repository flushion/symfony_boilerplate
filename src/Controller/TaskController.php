<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    #[Route('/task/create', name: 'app_task_create')]
    public function create(): Response
    {
        return $this->render('task/create.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    #[IsGranted('edit', 'post')]
    #[Route('/task/{id}/edit', name: 'app_task_edit')]
    public function edit($id): Response
    {
        return $this->render('task/edit.html.twig', [
            'controller_name' => 'TaskController',
            'id' => $id,
        ]);
    }

    #[IsGranted('view', 'post')]
    #[Route('/task/{id}/view', name: 'app_task_view')]
    public function view($id): Response
    {
        return $this->render('task/view.html.twig', [
            'controller_name' => 'TaskController',
            'id' => $id,
        ]);
    }

    #[IsGranted('delete', 'post')]
    #[Route('/task/{id}/delete', name: 'app_task_delete')]
    public function delete($id): Response
    {
        return $this->render('task/delete.html.twig', [
            'controller_name' => 'TaskController',
            'id' => $id,
        ]);
    }


}
