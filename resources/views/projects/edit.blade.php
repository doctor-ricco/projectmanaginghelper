@extends('layouts.app')

@section('title', 'Editar Projeto')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Projeto</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold" for="name">Nome do Projeto</label>
            <input type="text" id="name" name="name" class="w-full border p-2 rounded" required value="{{ old('name', $project->name) }}">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="description">Descrição</label>
            <textarea id="description" name="description" class="w-full border p-2 rounded">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="start_date">Data de Início</label>
            <input type="date" id="start_date" name="start_date" class="w-full border p-2 rounded" value="{{ old('start_date', $project->start_date) }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="end_date">Data de Fim</label>
            <input type="date" id="end_date" name="end_date" class="w-full border p-2 rounded" value="{{ old('end_date', $project->end_date) }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="status">Estado</label>
            <select id="status" name="status" class="w-full border p-2 rounded">
                <option value="planned" {{ $project->status == 'planned' ? 'selected' : '' }}>Planeado</option>
                <option value="started" {{ $project->status == 'started' ? 'selected' : '' }}>Iniciado</option>
                <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Atualizar Projeto</button>
        <a href="{{ route('projects.index') }}" class="text-gray-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
