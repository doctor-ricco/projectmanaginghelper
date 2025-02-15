<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks; // Obtém todas as tarefas do projeto para devolver a vista de tasks
        return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,started,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Tarefa criada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,started,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Tarefa atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
