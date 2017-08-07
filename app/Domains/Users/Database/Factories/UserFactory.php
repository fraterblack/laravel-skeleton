<?php

namespace Lpf\Domains\Users\Database\Factories;

use Lpf\Domains\Users\User;
use Lpf\Support\Domain\Database\ModelFactory;


/**
 * Class UserFactory.
 */
class UserFactory extends ModelFactory
{
    protected $model = User::class;

    protected function fields()
    {
        static $password;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password ?: $password = bcrypt('123456'),
        ];
    }
}