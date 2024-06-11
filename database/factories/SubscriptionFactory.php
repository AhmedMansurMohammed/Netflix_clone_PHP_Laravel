<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_type' => \App\Models\Type_subscription::factory(),
            'account_number' => $this->faker->bankAccountNumber,
            'entity' => $this->faker->company,
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expire_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
