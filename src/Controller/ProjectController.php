<?php

namespace App\Controller;

use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProjectController extends AbstractController
{
    #[Route('/', name: "app_homepage")]
    public function homepage(): Response
    {
        return $this->render('project/homepage.html.twig', [
            'title' => 'Witamy w notatniku !',
        ]);
    }

    #[Route('/browse', name: 'app_browse')]
    public function browse(EntityManagerInterface $entityManager): Response
    {
        $userId = $this->getUser()->getId();
        $notesRepository = $entityManager->getRepository(Note::class);
        $notes = $notesRepository->findUserNotesByCreatedAt($userId);

        return $this->render('project/browse.html.twig', [
            'title' => 'Przejrzyj notatki',
            'notes' => $notes,
        ]);
    }

}
