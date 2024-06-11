<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Assuming default password is 'password', you can change it accordingly
            'role' => $this->faker->randomElement(['ADMIN', 'USER']), // Assuming there are 'admin' and 'user' roles
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'remember_token' => Str::random(10),
        ];
    }
}
