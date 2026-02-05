<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class]);
        $this->call([DifficultySeeder::class]);

        if (config('app.env') === 'testing') {
            $this->call([
                CategorySeeder::class,
                QuestionSeeder::class,
            ]);

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role_id' => 1,
            ]);
        }

    }
}
