@extends('admin.layout')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Rooms</h1>
        <a href="{{ route('admin.rooms.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Ajouter une nouvelle rooms</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Label</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Description</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Prix par nuit (€)</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Options</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">value</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rooms as $room)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $room->label }}</td>
                        <td class="px-4 py-2">{{ $room->description }}</td>
                        <td class="px-4 py-2">{{ number_format($room->price_per_night, 2) }} €</td>
                        <td class="px-4 py-2">
                            @foreach ($room->roomOptions as $option)
                                <span>{{ $option->label }}: {{ $option->pivot->value }}</span><br>
                            @endforeach
                        </td>
                        <td class="px-4 py-2">
                            @foreach ($room->roomOptions as $option)
                                <span>{{ $option->name }}: {{ $option->pivot->value }}</span><br>
                            @endforeach
                        </td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $rooms->links() }}
        </div>
    </div>
@endsection
