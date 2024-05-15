@extends('admin.layout')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Ajouter un nouvel équipement</h1>
        <form action="{{ route('admin.options.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="icon" class="block text-gray-700">Nom de l'équipement</label>
                <input type="text" id="icon" name="icon" class="mt-2 p-2 border border-gray-300 rounded w-full" required>
                @error('icon')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="label" class="block text-gray-700">Description</label>
                <textarea id="label" name="label" class="mt-2 p-2 border border-gray-300 rounded w-full" required></textarea>
                @error('label')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
        </form>
    </div>
@endsection
