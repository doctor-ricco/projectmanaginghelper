@extends('layouts.app')

@section('title', 'Lista de Projetos')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-6">Projetos</h1>
    <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Novo Projeto</a>

    <table class="w-full mt-6 border-collapse border border-gray-300 shadow-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-left">EID</th>
                <th class="border px-4 py-2 text-left">Nome do Projeto</th>
                <th class="border px-4 py-2 text-left">Status</th>
                <th class="border px-4 py-2 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr class="hover:bg-gray-100 transition relative">
                <td class="border px-4 py-2">{{ $project->eid }}</td>
                <td class="border px-4 py-2">{{ $project->name }}</td>
                <td class="border px-4 py-2 capitalize">{{ $project->status }}</td>
                <td class="border px-4 py-2 text-center">
                    <div class="flex justify-center items-center space-x-4">
                        <a href="{{ route('projects.show', $project) }}" class="text-gray-400 hover:text-blue-700">Ver</a>
                        <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-blue-700 ml-2">Editar</a>
                        <button onclick="openModal('{{ $project->id }}')" class="text-gray-400 hover:text-red-700 ml-2">Excluir</button>
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
        <h2 class="text-xl font-bold text-gray-900 mb-4">Tens certeza?</h2>
        <p class="text-gray-700 mb-4">Este projeto será excluído permanentemente.</p>


        <div class="mt-6 flex justify-between gap-4">
            <form id="deleteForm" action="" method="POST">
                @csrf @method('DELETE')
                <button type="submit"
                    class="bg-red-600 !text-red-100 font-bold px-6 py-2 rounded hover:bg-red-700 border border-red-800 shadow-md">Excluir</button>

            </form>
            <button onclick="closeModal()"
                class="bg-gray-300 text-black font-bold px-4 py-2 rounded hover:bg-gray-400 w-full">
                Cancelar
            </button>
        </div>

    </div>
</div>

<script>
    function openModal(projectId) {
        let modal = document.getElementById('deleteModal');
        let form = document.getElementById('deleteForm');
        form.action = "/projects/" + projectId;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
