@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Tarefa - "{{ $task->title }}"</h1>

    <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold" for="title">Título</label>
            <input type="text" id="title" name="title" class="w-full border p-2 rounded" required value="{{ old('title', $task->title) }}">
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="description">Descrição</label>
            <textarea id="description" name="description" class="w-full border p-2 rounded">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="due_date">Data de Vencimento</label>
            <input type="date" id="due_date" name="due_date" class="w-full border p-2 rounded" value="{{ old('due_date', $task->due_date) }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="status">Status</label>
            <select id="status" name="status" class="w-full border p-2 rounded">
                <option value="planned" {{ $task->status == 'planned' ? 'selected' : '' }}>Planeada</option>
                <option value="started" {{ $task->status == 'started' ? 'selected' : '' }}>Iniciada</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Atualizar Tarefa</button>
        <a href="{{ route('projects.tasks.index', $project) }}" class="text-gray-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
