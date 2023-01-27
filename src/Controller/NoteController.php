<?php

namespace App\Controller;

use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    #[Route('/addNote')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $note = new Note();
        $note->setTitle('Notka nr 1');
        $note->setNoteContent("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has");

        $entityManager->persist($note);
        $entityManager->flush();

        return new Response(sprintf(
           "Dane nr %d zostały przesłane",
            $note->getId(),
        ));
    }
}