<?php

namespace App\DataFixtures;

use App\Factory\NoteFactory;
use App\Factory\UserFactory;
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

        UserFactory::createMany(15);

        NoteFactory::createMany(140, function () {
            return [
                'users' => UserFactory::random()
            ];
        });
        $manager->flush();
    }
}
