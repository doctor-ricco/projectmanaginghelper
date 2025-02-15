<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        foreach ($projects as $project) {
            Task::factory(5)->create([
                'project_id' => $project->id,
                'user_id' => $users->random()->id, // Atribui a tarefa a um usuário aleatório
            ]);
        }
    }
}
