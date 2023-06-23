<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Usuario',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\Admin::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\Moderator::create([
            'name' => 'Moderador',
            'email' => 'moderator@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\Financial::create([
            'name' => 'Financeiro Nivel 1',
            'email' => 'financial1@gmail.com',
            'level' => 1,
            'password' => bcrypt('12345678')
        ]);

        \App\Models\Financial::create([
            'name' => 'Financeiro Nivel 2',
            'email' => 'financial2@gmail.com',
            'level' => 2,
            'password' => bcrypt('12345678')
        ]);
    }
}
