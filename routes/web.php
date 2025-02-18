<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectExportController;
use App\Http\Controllers\TaskExportController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::resource('projects', ProjectController::class);
Route::resource('projects.tasks', TaskController::class);

//Rota para a exportação ddos projetos
Route::get('/projects/export/{format}', [ProjectExportController::class, 'export'])->name('projects.export');
//Rota para exportação das tasks
Route::get('/projects/{projectId}/tasks/export/{format}', [TaskExportController::class, 'export'])->name('tasks.export');

require __DIR__.'/auth.php';
