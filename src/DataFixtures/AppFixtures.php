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

        UserFactory::createOne([
            'email' => '1@wp.pl',
            'roles' => ['ROLE_ADMIN'],
        ]);
        UserFactory::createOne([
            'email' => '2@wp.pl'
        ]);
        UserFactory::createMany(10);

        NoteFactory::createMany(100, function() {
            return [
                'users' => UserFactory::random()
            ];
        });
        $manager->flush();
    }
}
