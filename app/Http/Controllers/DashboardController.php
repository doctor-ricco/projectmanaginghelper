<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de projetos
        $totalProjects = Project::count();

        // Tarefas
        $completedTasks = Task::where('status', 'completed')->count();
        $plannedTasks = Task::where('status', 'planned')->count();
        $startedTasks = Task::where('status', 'started')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();

        $totalTasks = $completedTasks + $plannedTasks + $startedTasks + $inProgressTasks;

        // Contagem de projetos por estágio
        $projectsByStatus = Project::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Criando um array com estágios esperados para garantir que sempre haja valores
        $projectStages = [
            'in_progress' => $projectsByStatus['in_progress'] ?? 0,
            'completed' => $projectsByStatus['completed'] ?? 0,
            'planned' => $projectsByStatus['planned'] ?? 0,
            'started' => $projectsByStatus['started'] ?? 0,
        ];

        return view('dashboard.index', compact(
            'totalProjects',
            'completedTasks',
            'projectStages',
            'plannedTasks',
            'startedTasks',
            'inProgressTasks',
            'totalTasks'
        ));
    }
}
