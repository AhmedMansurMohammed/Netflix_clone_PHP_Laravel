<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Country;
use App\Models\People;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'release_year' => $this->faker->year,
            'likes' => $this->faker->numberBetween(0, 1000),
            'director' => function () {
                $director = People::factory()->create(['profession' => 'DIRECTOR']);
                return $director->id_person;
            },
           // 'img_url' => $this->faker->imageUrl(640, 480, 'movies'),
            'img_url' =>'background.jpg',
            'isSerie' => $this->faker->boolean,
            'country' => function () {
                $country = Country::factory()->create();
                return $country->id_country;
            },
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Media $media) {
            $media->actors()->attach(
                People::factory()->count(3)->create(['profession' => 'ACTOR'])
            );

             $genres = Genre::inRandomOrder()->limit(3)->get();
             $media->genres()->attach($genres);
            
             if($media->isSerie){
                $episode = Episode::factory()->create([
                    'url' => 'https://mega.nz/embed/354WUYAY#fQwtOvU0mDl0FUR6ZqZxZPwZnLWpFXlRsL02W9upoyE',
                    'id_media' => $media->id_media, 
                ]);
             } else {
                $episode = Episode::factory()->create([
                    'url' => 'https://mega.nz/embed/354WUYAY#fQwtOvU0mDl0FUR6ZqZxZPwZnLWpFXlRsL02W9upoyE',
                    'id_media' => $media->id_media, 
                    'season' => null
                ]);
             }
            
            
        
          
            $media->episodes()->save($episode);
          //  dd($media->episodes->id_media);

            
        });
    }
}
