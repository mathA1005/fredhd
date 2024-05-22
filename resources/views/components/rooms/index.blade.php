@props(['rooms'])

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($rooms as $room)
        <div class="bg-white rounded-xl shadow-sm flex flex-col dark:bg-neutral-900 dark:shadow-neutral-700/70 my-4 mx-2">
            <div class="border-t border-l border-r border-gray-800 p-4 rounded-t-xl dark:border-neutral-700">
                <div class="relative w-full overflow-hidden pt-[56.25%] md:pt-[50%]">
                    <a href="{{ route('rooms.show', ['id' => $room->id]) }}">
                        <img class="absolute inset-0 w-full h-full object-cover rounded-t-xl" src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                    </a>
                </div>
                <div class="flex flex-col p-4 sm:p-5">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ $room->label }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-xs text-gray-500 dark:text-neutral-500">
                            {{ $room->price_per_night }} € / nuit
                        </p>
                    </div>
                    <div class="mt-3 flex-1">
                        <p class="text-xs text-gray-500 dark:text-neutral-500">
                            {{ $room->description }}
                        </p>
                    </div>
                    @if($room->roomOptions->isNotEmpty())
                        <div class="mt-5">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">Options :</h4>
                            <ul class="list-disc list-inside text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                                @foreach($room->roomOptions as $option)
                                    <li class="flex items-center">
                                        @if($option->icon)
                                            <i data-lucide="{{ $option->icon }}" class="ml-2 text-white"></i>
                                        @endif
                                        <span class="ml-2">{{ $option->label }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mt-5">
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500" href="{{ route('reservation.show', ['id' => $room->id]) }}">Réservez la chambre</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $rooms->links() }}
</div>
