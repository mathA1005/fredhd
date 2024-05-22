@props(['room', 'roomOptions'])

<div class="max-w-4xl mx-auto py-10 bg-white rounded-xl border border-gray-200 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 my-4 mx-2">
    <div class="p-4 rounded-xl">
        <img class="w-full object-cover rounded-xl mb-6" src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
        <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-neutral-300">{{ $room->label }}</h1>

        <p class="text-gray-600 dark:text-neutral-400 mb-4">{{ $room->description }}</p>
        <p class="text-xl font-semibold text-gray-800 dark:text-neutral-300 mb-4">{{ $room->price_per_night }} € / nuit</p>

        <!-- Liste des options de chambre -->
        <h2 class="font-bold mb-2 text-gray-800 dark:text-neutral-300">Options de chambre:</h2>
        @foreach($roomOptions as $roomOption)
            <div class="flex items-center mb-4 text-gray-600 dark:text-neutral-300">
                @if($roomOption->icon)
                    <i data-lucide="{{ $roomOption->icon }}" class="ml-2 text-gray-800 dark:text-neutral-300"></i>
                @endif
                <span class="ml-2">{{ $roomOption->label }}</span>
            </div>
        @endforeach

        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500">Réservez la chambre</button>
    </div>
</div>
