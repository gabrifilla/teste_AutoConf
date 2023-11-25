<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Usuário',
            'email' => 'user@example.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Usuário2',
            'email' => 'user2@example.com',
            'password' => Hash::make('123'),
        ]);
    }
}
