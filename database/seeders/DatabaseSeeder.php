<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder lain
        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
