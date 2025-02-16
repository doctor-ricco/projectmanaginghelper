@extends('layouts.app')

@section('title', 'Detalhes do Projeto')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-2">{{ $project->name }}</h1>
    <p class="text-gray-600 text-lg mb-4"><strong>EID:</strong> {{ $project->eid }}</p>

    <p class="text-gray-700 mb-2"><strong>Descrição:</strong> {{ $project->description ?? 'Sem descrição' }}</p>

    <p class="text-gray-700 mb-2"><strong>Data de Início:</strong> {{ $project->start_date ?
        \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') : 'Não definida' }}</p>

    <p class="text-gray-700 mb-2"><strong>Data de Fim:</strong> {{ $project->end_date ?
        \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'Não definida' }}</p>

    <p class="text-gray-700 mb-2">
        <strong>Status:</strong>
        <span
            class="px-2 py-1 rounded {{ $project->status == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-800' }}">
            {{ ucfirst($project->status) }}
        </span>
    </p>


    <td class="border px-4 py-2 text-center">
        <div class="flex  space-x-4">
            <a href="{{ route('projects.tasks.index', $project) }}" class="text-gray-400 hover:text-blue-700 ml-2">Ver Tarefas</a>
            <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-700 ml-4">Editar</a>
            <a href="{{ route('projects.index') }}"class="text-gray-400 hover:text-yellow-700 ml-4">Voltar</a>
        </div>
    </td>
<!--
    <div class="mt-6">
        <a href="{{ route('projects.tasks.index', $project) }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">
            Ver Tarefas
        </a>
        <a href="{{ route('projects.edit', $project) }}"
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 ml-2">Editar</a>
        <a href="{{ route('projects.index') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-1">Voltar</a>
    </div> -->
</div>
@endsection
