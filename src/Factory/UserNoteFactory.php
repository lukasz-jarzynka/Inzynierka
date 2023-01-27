<?php

namespace App\Factory;

use App\Entity\UserNote;
use App\Repository\UserNoteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UserNote>
 *
 * @method        UserNote|Proxy create(array|callable $attributes = [])
 * @method static UserNote|Proxy createOne(array $attributes = [])
 * @method static UserNote|Proxy find(object|array|mixed $criteria)
 * @method static UserNote|Proxy findOrCreate(array $attributes)
 * @method static UserNote|Proxy first(string $sortedField = 'id')
 * @method static UserNote|Proxy last(string $sortedField = 'id')
 * @method static UserNote|Proxy random(array $attributes = [])
 * @method static UserNote|Proxy randomOrCreate(array $attributes = [])
 * @method static UserNoteRepository|RepositoryProxy repository()
 * @method static UserNote[]|Proxy[] all()
 * @method static UserNote[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static UserNote[]|Proxy[] createSequence(array|callable $sequence)
 * @method static UserNote[]|Proxy[] findBy(array $attributes)
 * @method static UserNote[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserNote[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class UserNoteFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'password' => self::faker()->password(6,20),
            'phoneNumber' => self::faker()->randomNumber(9),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(UserNote $userNote): void {})
        ;
    }

    protected static function getClass(): string
    {
        return UserNote::class;
    }
}
