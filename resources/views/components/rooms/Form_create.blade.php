
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une nouvelle chambre</title>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-lg mx-auto">
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="label">
                Nom de la chambre
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="label" name="label" type="text" placeholder="Nom de la chambre">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4" placeholder="Description de la chambre"></textarea>
        </div>

        @foreach ($roomOptions as $roomOption)
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-indigo-600" name="roomOptions[]" value="{{ $roomOption->id }}">
                    <span class="ml-2">{{ $roomOption->label }}</span>
                </label>
                <input type="text" name="roomOptionsValues[{{ $roomOption->id }}]" placeholder="Valeur pour {{ $roomOption->label }}" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        @endforeach

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
                Photo de la chambre
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" name="picture" type="file">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Créer
            </button>
        </div>
    </form>
</div>


</body>
</html>
