<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\User;
use App\Entity\UserNote;
use App\Form\ProfileForm;
use App\Form\RegistrationFormType;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;


class ProjectController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {
    }

    #[Route('/', name: "app_homepage")]
    public function homepage(): Response
    {
        return $this->render('project/homepage.html.twig', [
            'title' => 'Witamy w notatniku',
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
    #[Route('/addNotes', name: 'app_addnotes')]
    public function newNote()
    {
        if (!$this->isGranted('ROLE_USER'))
        {
            throw $this->createAccessDeniedException('Brak dostępu!');
        }
        return new Response('dodano notatkę');
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
    #[Route('/addNote', name: 'app_addnote')]
    public function addNote()
    {
        return $this->render('project/addNote.html.twig');
    }



}
