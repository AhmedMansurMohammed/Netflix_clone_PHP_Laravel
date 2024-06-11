<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Type_subscription;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el usuario administrador
        $admin = User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('admin'),
            'role' => 'ADMIN',
            'phone_number' => "123456789",
            'address' => "Calle Berlin 67"
        ]);
        // Obtener el tipo de suscripción "PRO"
        $proSubscription = Type_subscription::where('type', 'PRO')->first();

        // Asociar la suscripción "PRO" al usuario administrador
        $admin->subscriptions()->create([
            'id_type' => $proSubscription->id_type,
            'entity' => "Admin Entity",
            'account_number' => "Admin Account Number",
            'start_date' => now(),
            'expire_date' => now()->addMonths($proSubscription->duration),
        ]);


        User::create([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => bcrypt('user'),
            'role' => 'USER',
            'phone_number' => "123456789",
            'address' => "Calle Berlin 67"
        ]);
    }
}
