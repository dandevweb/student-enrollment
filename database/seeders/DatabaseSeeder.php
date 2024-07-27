<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Secretaria',
            'email' => 'secretaria@example.com',
            'role'  => RoleEnum::Secretary,
        ]);

        User::factory()->create([
            'name'  => 'Assistente',
            'email' => 'assistente@example.com',
            'role'  => RoleEnum::Assistant,
        ]);

        User::factory()->create([
            'name'  => 'Cadastro',
            'email' => 'cadastro@example.com',
            'role'  => RoleEnum::Register,
        ]);

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            StudentSeeder::class,
            ClassesSeeder::class,
        ]);
    }
}
