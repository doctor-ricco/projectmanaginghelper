@extends('layouts.app')

@section('title', 'Criar Novo Projeto')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Criar Novo Projeto</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <!--

            NOTA pra mim mesmo: csrf permite evitar "Cross-Site Request Forgery", que é um tipo de ataque
            onde um usuário autenticado pode ser induzido a enviar requisições maliciosas sem querer.

            Sempre que enviar um formulário no Laravel, ele precisa ter um token CSRF para garantir
            que a requisição veio da aplicação. O csrf adiciona esse token ao <form> automaticamente.

        -->

        <div class="mb-4">
            <label class="block font-semibold" for="name">Nome do Projeto</label>
            <input type="text" id="name" name="name" class="w-full border p-2 rounded" required
                value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="eid">EID</label>
            <input type="text" id="eid" name="eid" class="w-full border p-2 rounded" required value="{{ old('eid') }}">
            @error('eid')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <label class="block font-semibold" for="description">Descrição</label>
            <textarea id="description" name="description"
                class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="start_date">Data de Início</label>
            <input type="date" id="start_date" name="start_date" class="w-full border p-2 rounded"
                value="{{ old('start_date') }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="end_date">Data de Fim</label>
            <input type="date" id="end_date" name="end_date" class="w-full border p-2 rounded"
                value="{{ old('end_date') }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold" for="status">Estado</label>
            <select id="status" name="status" class="w-full border p-2 rounded">
                <option value="planned" {{ old('status')=='planned' ? 'selected' : '' }}>Planeado</option>
                <option value="started" {{ old('status')=='started' ? 'selected' : '' }}>Iniciado</option>
                <option value="in_progress" {{ old('status')=='in_progress' ? 'selected' : '' }}>Em Progresso</option>
                <option value="completed" {{ old('status')=='completed' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Criar Projeto</button>
        <a href="{{ route('projects.index') }}" class="text-gray-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
