<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Genre::create([
            'name' => 'Action',
        ]);
        Genre::create([
            'name' => 'Adventure',
        ]);
        Genre::create([
            'name' => 'Comedy',
        ]);
        Genre::create([
            'name' => 'Drama',
        ]);
        Genre::create([
            'name' => 'Horror',
        ]);
        Genre::create([
            'name' => 'Romance',
        ]);
    }
}
