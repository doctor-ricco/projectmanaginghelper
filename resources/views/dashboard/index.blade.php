@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div>
        <h1 class="text-2xl font-bold mb-4">Resumo dos Projetos</h1>
    </div>

    <!-- Container principal ocupando toda a largura -->
    <div class="bg-white p-6 rounded-lg shadow flex items-center gap-8 w-full">


        <!-- Estatísticas (Metade Esquerda) -->
        <div class="flex-1 grid grid-cols-2 gap-2">
            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Planeados</h2>
                <p class="text-3xl font-bold" style="color: #d3d3d3;">{{ $projectStages['planned'] }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Iniciados</h2>
                <p class="text-3xl font-bold" style="color: #3b82f6;">{{ $projectStages['started'] }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Em Andamento</h2>
                <p class="text-3xl font-bold" style="color: #ffa500;">{{ $projectStages['in_progress'] }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Concluídos</h2>
                <p class="text-3xl font-bold" style="color: #10b981;">{{ $projectStages['completed'] }}</p>
            </div>
            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Total</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalProjects }}</p>
            </div>

        </div>

        <!-- Gráfico de Pizza (Metade Direita) -->
        <div class="flex-1 flex justify-center">
            <canvas id="projectsChart" style="max-width: 600px; max-height: 600px;"></canvas>
        </div>

    </div>
</div>

<!-- Importar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("projectsChart").getContext("2d");

        var projectsChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: ["Planeado", "Iniciado", "Em Andamento", "Concluído"],
                datasets: [{
                    data: [
                        {{ $projectStages['planned'] }},
                        {{ $projectStages['started'] }},
                        {{ $projectStages['in_progress']}},
                        {{ $projectStages['completed'] }}
                    ],
                    backgroundColor: ["#d3d3d3", "#3b82f6", "#ffa500", '#10b981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            },
                            boxWidth: 30,
                            boxHeight: 10,
                            padding: 8
                        }
                    }
                }
            }
        });
    });
</script>


<!-- testando gráfico de barras verticais-->

<div class="container mx-auto px-4 py-6">

    <div>
        <h1 class="text-2xl font-bold mb-4">Resumo das Tarefas</h1>
    </div>

    <!-- Container principal ocupando toda a largura -->
    <div class="bg-white p-6 rounded-lg shadow flex items-center gap-8 w-full">

        <!-- Estatísticas (Metade Esquerda) -->
        <div class="flex-1 grid grid-cols-2 gap-2">
            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Planeadas</h2>
                <p class="text-3xl font-bold" style="color: #d3d3d3;">{{ $plannedTasks }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Iniciadas</h2>
                <p class="text-3xl font-bold" style="color: #3b82f6;">{{ $startedTasks }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Em Andamento</h2>
                <p class="text-3xl font-bold" style="color: #ffa500;">{{ $inProgressTasks }}</p>
            </div>

            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Concluídas</h2>
                <p class="text-3xl font-bold" style="color: #10b981;">{{ $completedTasks }}</p>
            </div>
            <div class="p-6 border rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold">Total</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalTasks }}</p>
            </div>

        </div>

        <!-- Gráfico de Barras (Metade Direita) -->
        <div class="flex-1 flex justify-center">
            <canvas id="tasksBarChart" style="max-width: 600px; max-height: 400px;"></canvas>
        </div>

    </div>
</div>

<!-- Importar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("tasksBarChart").getContext("2d");

        var tasksBarChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Planeada", "Iniciada", "Em Andamento", "Concluída"],
                datasets: [{
                    label: "Quantidade de Tarefas",
                    data: [
                        {{ $plannedTasks }},
                        {{ $startedTasks }},
                        {{ $inProgressTasks }},
                        {{ $completedTasks }}
                    ],
                    backgroundColor: ["#d3d3d3", "#3b82f6", "#ffa500", '#10b981'],
                    borderColor: ["#a9a9a9", "#2563eb", "#ff8c00", "#059669"],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Esconde a legenda para manter o design limpo
                    }
                }
            }
        });
    });
</script>


@endsection
