<?php

namespace Database\Factories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'title' => $this->faker->sentence,
            'duration' => $this->faker->numberBetween(10, 60),
            'description' => $this->faker->paragraph,
            'id_media' => 1,
            'season' => $this->faker->numberBetween(1,3),
        ];
    }
}
