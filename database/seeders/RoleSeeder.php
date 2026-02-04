<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'slug' => 'user', 'name' => 'Benutzer'],
            ['id' => 2, 'slug' => 'editor', 'name' => 'Redakteur'],
            ['id' => 3, 'slug' => 'admin', 'name' => 'Administrator'],
            ['id' => 4, 'slug' => 'superadmin', 'name' => 'System-Admin'],
        ];

        foreach ($data as $row) {
            Role::query()->updateOrCreate(['id' => $row['id']], $row);
        }
    }
}
