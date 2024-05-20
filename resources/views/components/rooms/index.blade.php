@props(['rooms'])

@foreach($rooms as $room)
    <div class="bg-white border rounded-xl shadow-sm sm:flex dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 my-8">
        <div class="flex-shrink-0 relative w-full rounded-t-xl overflow-hidden pt-[2%] sm:rounded-s-xl sm:max-w-60 md:rounded-se-none md:max-w-xs">
            <a href="{{ route('rooms.show', ['id' => $room->id]) }}">
                <img class="size-full absolute top-0 start-0 object-cover"
                     src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
            </a>
        </div>

        <div class="flex flex-wrap">
            <div class="p-4 flex flex-col h-full sm:p-7">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    {{ $room->label }}

                </h3>
                <div class="">
                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                        {{ $room->price_per_night }}
                    </p>
                </div>

                <div class="mt-5 sm:mt-auto">
                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                        {{ $room->description }}
                    </p>
                </div>
                <div class="mt-11">
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500" href="{{ route('reservation.show', ['id' => $room->id]) }}">Réservez la chambre</a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="mt-6">
    {{ $rooms->links() }}
</div>
