<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['sehr leicht', 'leicht', 'mittel', 'schwer', 'sehr schwer'];

        foreach ($names as $name) {
            Difficulty::query()->firstOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}
