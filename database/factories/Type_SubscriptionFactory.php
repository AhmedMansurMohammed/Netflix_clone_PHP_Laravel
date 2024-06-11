<?php

namespace Database\Factories;

use App\Models\Type_subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeSubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Type_subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'duration' => $this->faker->randomElement([1, 3, 6, 12]),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
