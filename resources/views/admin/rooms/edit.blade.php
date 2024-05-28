@extends('admin.layout')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Editer la chambre</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">Il y a quelques problèmes avec votre entrée.</span>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="label">
                    Nom de la chambre
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="label" name="label" type="text" value="{{ old('label', $room->label) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4" required>{{ old('description', $room->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price_per_night">
                    Prix par nuit (€)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price_per_night" name="price_per_night" type="number" step="0.01" value="{{ old('price_per_night', $room->price_per_night) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
                    Photo principale de la chambre
                </label>
                @if($room->picture)
                    <div class="mb-4">
                        <img src="{{ Storage::url($room->picture) }}" alt="Photo actuelle" class="w-48">
                    </div>
                @endif
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" name="picture" type="file">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="pictures">
                    Photos supplémentaires de la chambre
                </label>
                @foreach($room->pictures as $picture)
                    <div class="mb-2">
                        <img src="{{ Storage::url($picture->path) }}" alt="Photo supplémentaire" class="w-24 inline-block mr-2">
                    </div>
                @endforeach
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pictures" name="pictures[]" type="file" multiple>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Options de la chambre
                </label>
                @foreach($roomOptions as $option)
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-indigo-600" name="roomOptions[]" value="{{ $option->id }}" id="option-{{ $option->id }}"
                                   @if(in_array($option->id, array_keys($roomOptionsValues))) checked @endif>
                            <span class="ml-2">{{ $option->label }}</span>
                        </label>
                        <input type="text" name="roomOptionsValues[{{ $option->id }}]" placeholder="Valeur pour {{ $option->label }}" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $roomOptionsValues[$option->id] ?? '' }}">
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Mettre à jour la chambre
                </button>
            </div>
        </form>
    </div>
@endsection
