<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'full_name' => 'Иванова Ольга Ивановна',
            'email' => 'instructor@example.com',
            'password' => Hash::make('password123'),
            'phone' => '89123456765',
            'role' => 'instructor',
            'photo' => 'driver1.png'
        ]);

        User::create([
            'full_name' => 'Петров Иван Сергеевич',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'phone' => '89998887766',
            'role' => 'visitor',
            'photo' => null
        ]);

        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'full_name' => "Пользователь Тестовый $i",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password123'),
                'phone' => '8900' . rand(1000000, 9999999),
                'role' => 'visitor',
            ]);
        }
    }
}