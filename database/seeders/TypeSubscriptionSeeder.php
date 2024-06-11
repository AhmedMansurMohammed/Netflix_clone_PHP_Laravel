<?php

namespace Database\Seeders;

use App\Models\Type_subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Type_subscription::create([
            'id_type' => 1,
            'type' => 'FREE',
            'duration' => '30',
            'price' => '0',
        ]);
        Type_subscription::create([
            'id_type' => 2,
            'type' => 'PLUS',
            'duration' => '30',
            'price' => '9',
        ]);
        Type_subscription::create([
            'id_type' => 3,
            'type' => 'PRO',
            'duration' => '30',
            'price' => '19',
        ]);
    }
}
