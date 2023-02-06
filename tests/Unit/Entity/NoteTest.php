<?php

namespace Unit\Entity;

use App\Entity\Note;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class NoteTest extends TestCase
{
    public function testCanGetAndSetData(): void
    {

        $user = new User();
        $user->setPassword('xxx');
        $user->setEmail('1@wp.pl');
        $user->setFirstName('fName');
        $user->setLastName('lName');
        $user->setPhoneNumber(312313);

        $note = new Note();
        $note->setNoteContent('testNoteContent');
        $note->setTitle('testNoteTitle');
        $note->setUsers($user);

        self::assertSame('testNoteTitle', $note->getTitle());
        self::assertSame('testNoteContent', $note->getNoteContent());
        self::assertSame($user, $note->getUsers());
    }
}