<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\ReviewTheme::factory()->create([
            'slug' => 'gratitude',
            'name' => 'Вдячність',
        ]);

        \App\Models\ReviewTheme::factory()->create([
            'slug' => 'proposal',
            'name' => 'Пропозиція щодо вдосконалення послуг',
        ]);

        \App\Models\ReviewTheme::factory()->create([
            'slug' => 'complaint',
            'name' => 'Скарга',
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \bcrypt('admin123')
        ]);

        \App\Models\Review::factory(100)->create();
    }
}
