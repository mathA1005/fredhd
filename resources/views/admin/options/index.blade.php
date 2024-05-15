@extends('admin.layout')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Admin - Options de Salle</h1>
        <a href="{{ route('admin.options.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Ajouter une nouvelle option</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-4">
            <ul class="list-disc list-inside">
                @foreach ($roomOptions as $option)
                    <li class="py-2">
                        <span class="font-semibold">{{ $option->label }}</span>
                        <span class="text-gray-600">({{ $option->icon }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
