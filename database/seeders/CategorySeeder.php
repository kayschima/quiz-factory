<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Trainer',
            'Spieler',
            'Funktionäre',
            'Stadion',
            'Verein',
            'Historie',
            'Stadtteil',
        ];

        foreach ($names as $name) {
            Category::query()->firstOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}
