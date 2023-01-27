<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Factory\NoteFactory;
use App\Factory\UserFactory;
use App\Factory\UserNoteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $userNotes = UserNoteFactory::createMany(6);

        UserFactory::createOne(['email' => '1@wp.pl']);
        UserFactory::createMany(10);

        NoteFactory::createMany(40, function () use ($userNotes) {
            return [
                'userNote' => $userNotes[array_rand($userNotes)],
            ];
        });
    }
}
