@extends('layouts.app')

@section('title', 'Detalhes da Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $task->title }}</h1>

    <p class="text-gray-700 mb-2"><strong>Descrição:</strong> {{ $task->description ?? 'Sem descrição' }}</p>

    <p class="text-gray-700 mb-2"><strong>Data de Vencimento:</strong>
        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Não definida' }}
    </p>

    <p class="text-gray-700 mb-2">
        <strong>Status:</strong>
        <span class="px-2 py-1 rounded {{ $task->status == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-800' }}">
            {{ ucfirst($task->status) }}
        </span>
    </p>

    <div class="mt-6 space-x-4">
        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Editar
        </a>
        <a href="{{ route('projects.tasks.index', $project) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">
            Voltar
        </a>
    </div>
</div>
@endsection
