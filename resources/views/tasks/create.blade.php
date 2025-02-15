@extends('layouts.app')

@section('title', 'Criar Nova Tarefa')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Nova Tarefa para "{{ $project->name }}"</h1>

    <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold" for="title">Título</label>
            <input type="text" id="title" name="title" class="w-full border p-2 rounded" required value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="description">Descrição</label>
            <textarea id="description" name="description" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="due_date">Data de Vencimento</label>
            <input type="date" id="due_date" name="due_date" class="w-full border p-2 rounded" value="{{ old('due_date') }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="status">Status</label>
            <select id="status" name="status" class="w-full border p-2 rounded">
                <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planeada</option>
                <option value="started" {{ old('status') == 'started' ? 'selected' : '' }}>Iniciada</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Criar Tarefa</button>
        <a href="{{ route('projects.tasks.index', $project) }}" class="text-gray-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
