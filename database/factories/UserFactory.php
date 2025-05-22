<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'role' => fake()->randomElement(['seller', 'user']),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('12345678'),
            'address' => $this->faker->streetAddress,
            'gender' => fake()->randomElement(['male', 'female']),
            'status'=> 1,
            'phone'=> $this->faker->phoneNumber,
        ];
    }
}
