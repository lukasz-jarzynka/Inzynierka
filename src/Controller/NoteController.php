<?php

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends AbstractController
{


    public function __construct(private NoteRepository $noteRepository)
    {

    }

    #[Route('/saveNote', name: 'app_savenote')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $title = $request->get('title');
        $content = $request->get('noteContent');
        if ($content == '') {
            $message = 'Dane nie zostały przesłane!';
        } else {
            $note = new Note();
            $note->setTitle($title);
            $note->setNoteContent($content);
            $note->setUsers($this->getUser());

            $entityManager->persist($note);
            $entityManager->flush();

            $message = 'Dane zostały przesłane!';
        }
        return $this->render('project/homepage.html.twig', [
            'title' => $message,
        ]);
    }

    #[Route('/saveEditedNote', name: 'app_saveeditednote')]
    public function saveEditedNote(EntityManagerInterface $entityManager, Request $request): Response
    {
        $title = $request->get('title');
        $content = $request->get('noteContent');
        $noteId = $request->get('noteId');

        if (
            !$content || !$noteId
        ) {
            $message = 'Niepoprawne dane!';
        } else {
            $note = $this->noteRepository->find($noteId);
            $note->setTitle($title);
            $note->setNoteContent($content);

            $entityManager->persist($note);
            $entityManager->flush();

            $message = 'Dane zostały zaktualizowane!';
        }
        return $this->render('project/homepage.html.twig', [
            'title' => $message,
        ]);
    }

    #[Route('/deleteNote', name: 'app_deletenote')]
    public function delete(EntityManagerInterface $entityManager, Request $request): Response
    {
        $noteId = $request->get('noteId');

        if (!$noteId) {
            $message = 'Niepoprawne dane';
        } else {
            $note = $this->noteRepository->find($noteId);

            if (!$note) {
                $message = 'Podany obiekt nie istnieje';
            } else {
                $entityManager->remove($note);
                $entityManager->flush();
                $message = 'Dane zostały usunięte';
            }
        }
        return $this->render('project/homepage.html.twig', [
            'title' => $message,
        ]);
    }

    #[Route('/editNote', name: 'app_editnote')]
    public function edit(EntityManagerInterface $entityManager, Request $request): Response
    {
        $noteId = $request->get('noteId');

        $errorMessage = '';
        if (!$noteId) {
            $errorMessage = 'Niepoprawne dane';
        } else {
            $note = $this->noteRepository->find($noteId);

            if (!$note) {
                $errorMessage = 'Podany obiekt nie istnieje';
            }
        }
        return $this->render('project/editNote.html.twig', [
            'note' => $note,
            'errorMessage' => $errorMessage,
        ]);
    }
}