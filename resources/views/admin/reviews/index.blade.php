@extends('admin.layout')
@section('content')
    <body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Liste des Reviews</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Commentaire</th>
                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reviews as $review)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-4 py-2 break-words max-w-xs">{{ $review->user->name }}</td>
                    <td class="px-4 py-2 break-words max-w-xs">{{ $review->comment }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </body>
@endsection
