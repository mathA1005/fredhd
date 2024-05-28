@props(['rooms'])
<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6 justify-center ">
        @foreach($rooms as $room)
            <!-- Card -->
                <a class="dark:bg-neutral-900 group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-neutral-700 dark:hover:border-transparent dark:hover:shadow-black/40" href="{{ route('rooms.show', $room->id) }}">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full object-cover rounded-xl" src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                    </div>
                    <div class="my-6">
                        <h3 class="text-lg font-bold text-customGreen">
                            {{ $room->label }}
                        </h3>
                        <p class="mt-5 text-white">
                            {{ $room->description }}
                        </p>
                        <p class="mt-5  text-white">{{ $room->price_per_night }} € / nuit</p>

                        <!-- Affichage des options -->
                        @if($room->roomOptions->isNotEmpty())
                            <div class="mt-5">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">Options :</h4>
                                <ul class="list-disc list-inside text-gray-600 dark:text-neutral-300 dark:group-hover:text-white ">
                                    @foreach($room->roomOptions as $option)
                                        <li class="flex items-center">
                                            <i data-lucide="{{ $option->icon }}" class=" text-customGreen mr-2"></i>
                                            <span>{{ $option->label }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </a>
                <!-- End Card -->
            @endforeach
        </div>
        <!-- End Grid -->
    </div>
</div>
