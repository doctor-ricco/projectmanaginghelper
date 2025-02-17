@extends('layouts.app')

@section('title', 'Tarefas do Projeto')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-6">{{ $project->name }} - Tarefas</h1>

    <a href="{{ route('projects.tasks.create', $project) }}"
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        Nova Tarefa
    </a>
    <a href="{{ route('projects.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-1">
        Voltar
    </a>

    <a  href="{{ route('tasks.export', ['projectId' => $project->id, 'format' => 'csv']) }}"
        class="text-gray-400 hover:text-blue-700 ml-2">Exportar CSV</a>

        <a  href="{{ Route('tasks.export', ['projectId' => $project->id, 'format' => 'xlsx']) }}"
        class="text-gray-400 hover:text-blue-700 ml-2">Exportar XLSX</a>

    <table class="w-full mt-6 border-collapse border border-gray-300 shadow-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-left">Título</th>
                <th class="border px-4 py-2 text-left">Status</th>
                <th class="border px-4 py-2 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr class="hover:bg-gray-100 transition">
                <td class="border px-4 py-2">

                    @if ($task->status !== 'completed')
                    @if ($task->isDueToday())
                    <span class="text-red-500 font-bold" title="Esta tarefa vence HOJE">🔴</span>
                    @elseif ($task->isDueTomorrow())
                    <span class="text-yellow-500 font-bold" title="Esta tarefa vence AMANHÃ">🟡</span>
                    @endif
                    @endif


                    <span class="ml-2">{{ $task->title }}</span>
                </td>
                <td class="border px-4 py-2 capitalize">{{ $task->status }}</td>
                <td class="border px-4 py-2 text-center">
                    <div class="flex justify-center items-center space-x-4">

                        <a href="{{ route('projects.tasks.show', [$project, $task])  }}"
                            class="text-gray-400 hover:text-blue-700">Ver</a>
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                            class="text-gray-400 hover:text-blue-700 ml-2">Editar</a>

                        <button onclick="openModal('{{ route('projects.tasks.destroy', [$project, $task])}}')"
                            class="text-gray-400 hover:text-red-700 ml-2">Excluir</button>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de Confirmação -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
        <h2 class="text-xl font-bold mb-4">Tens certeza?</h2>
        <p>Esta tarefa será excluída permanentemente.</p>
        <div class="mt-6 flex justify-between gap-4">
            <form id="deleteForm" action="" method="POST">
                @csrf @method('DELETE')
                <button type="submit"
                    class="bg-red-600 text-red-100 font-bold px-6 py-2 rounded hover:bg-red-700 border border-red-800 shadow-md">
                    Excluir
                </button>
            </form>
            <button onclick="closeModal()"
                class="bg-gray-300 text-black font-bold px-4 py-2 rounded hover:bg-gray-400 w-full">
                Cancelar
            </button>
        </div>
    </div>
</div>

<script>
    function openModal(deleteUrl) {
        document.getElementById('deleteForm').action = deleteUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
