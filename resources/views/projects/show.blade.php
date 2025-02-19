@extends('layouts.app')

@section('title', 'Detalhes do Projeto')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div>
        <h1 class="text-2xl font-bold mb-4">Detalhes do Projeto</h1>
    </div>

    <!-- Container principal ocupando toda a largura -->
    <div class="bg-white p-6 rounded-lg shadow flex items-center gap-8 w-full">

        <!-- Informações do Projeto (Metade Esquerda) -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-2">{{ $project->name }}</h1>
            <p class="text-gray-600 text-lg mb-4"><strong>EID:</strong> {{ $project->eid }}</p>

            <p class="text-gray-700 mb-2"><strong>Descrição:</strong> {{ $project->description ?? 'Sem descrição' }}</p>

            <p class="text-gray-700 mb-2"><strong>Data de Início:</strong> {{ $project->start_date ?
                \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') : 'Não definida' }}</p>

            <p class="text-gray-700 mb-2"><strong>Data de Fim:</strong> {{ $project->end_date ?
                \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'Não definida' }}</p>

            <p class="text-gray-700 mb-2">
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded
                    {{ $project->status == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-800' }}">
                    {{ ucfirst($project->status) }}
                </span>
            </p>

            <div class="flex space-x-4 mt-4">
                <a href="{{ route('projects.tasks.index', $project) }}" class="text-gray-400 hover:text-blue-700">Ver
                    Tarefas</a>
                <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-700">Editar</a>
                <a href="{{ route('projects.index') }}" class="text-gray-400 hover:text-yellow-700">Voltar</a>
            </div>
        </div>

        <!-- Gráfico de Barras (Metade Direita) -->
        <div class="flex-1 flex justify-center">
            <div class="bg-gray-100 p-6 rounded-lg shadow w-full">
                <h2 class="text-xl font-semibold mb-4">Resumo das Tarefas</h2>
                <canvas id="taskChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('taskChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Planeada', 'Iniciada', 'Em Andamento', 'Concluída'],
                datasets: [{
                    label: 'Número de Tarefas',
                    data: [{{ $plannedTasks }}, {{ $startedTasks }}, {{ $inProgressTasks }}, {{ $completedTasks }}],
                    backgroundColor: ['#d3d3d3', '#3b82f6', '#ffa500', '#10b981'],
                    borderWidth: 1
                }]
            },
            options: {
    responsive: true,
    indexAxis: 'y', // Barras horizontais
    scales: {
        x: { beginAtZero: true }
    },
    plugins: {
        legend: {
            display: false // Desativa a legenda e remove a caixinha
        }
    }
}

        });
    });
</script>
@endsection
