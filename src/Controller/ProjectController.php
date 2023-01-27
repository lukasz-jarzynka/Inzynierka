<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\UserNote;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;


class ProjectController extends AbstractController
{
    #[Route('/', name: "app_homepage")]
    public function homepage(): Response
    {
        return $this->render('project/homepage.html.twig', [
            'title' => 'Witamy!',
        ]);
    }
    #[Route('/browse', name: 'app_browse')]
    public function browse(EntityManagerInterface $entityManager): Response
    {
        $notesRepository = $entityManager->getRepository(Note::class);
        $notes = $notesRepository->findAllByCreatedAt();

        return $this->render('project/browse.html.twig', [
            'mainTitle' => 'Przejrzyj notatki',
            'notes' => $notes,
        ]);
    }

    #[Route('/note', name: 'app_note')]
    public function show(UserNote $userNote){

        $note = $userNote->getNotes();

        return $this->render('project/browse.htm.twig', [

        ]);
    }

    #[Route('/addUser', name: "app_adduser")]
    public function addUser(): Response
    {
        return new Response();
    }
}
