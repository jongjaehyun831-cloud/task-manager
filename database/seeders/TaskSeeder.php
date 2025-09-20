<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'project_id' => 1, // pastikan project dengan ID 1 ada
            'title' => 'Membuat halaman login',
            'description' => 'Task untuk membuat halaman login user',
            'is_done' => false,
            'due_date' => now()->addDays(5),
            'assigned_to' => 1, // pastikan user dengan ID 1 ada
            'status' => 'not started',
        ]);

        Task::create([
            'project_id' => 1,
            'title' => 'Integrasi API',
            'description' => 'Menghubungkan project dengan API eksternal',
            'is_done' => false,
            'due_date' => now()->addDays(10),
            'assigned_to' => 2, // pastikan user dengan ID 2 ada
            'status' => 'in progress',
        ]);
    }
}
