<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', ProjectController::class);

Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');


Route::resource('projects.tasks', TaskController::class);

