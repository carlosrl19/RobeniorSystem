<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Lista de usuarios a crear
        $users = [
            [
                'name' => 'Carlos Rodriguez',
                'email' => 'admin@dev.com',
                'profile_photo' => '',
                'password' => Hash::make('Nightmare1998#@'),
            ],
            [
                'name' => 'Jafeth Guifarro',
                'email' => 'jafeth@robenior.com',
                'profile_photo' => '',
                'password' => Hash::make('Depredador2'),
            ],
        ];

        // Crear los usuarios en la base de datos
        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Evita duplicados basados en el email
                $user
            );
        }
    }
}
