@props(['id', 'picture', 'room_name', 'area', 'nb_person', 'room_description', 'status', 'options'])

<div
    class="bg-white border rounded-xl shadow-sm sm:flex dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 my-8">
    <div
        class="flex-shrink-0 relative w-full rounded-t-xl overflow-hidden pt-[2%] sm:rounded-s-xl sm:max-w-60 md:rounded-se-none md:max-w-xs">
        <img class="size-full absolute top-0 start-0 object-cover"
             src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2532&q=80"
             alt="Image Description">
    </div>
    <div class="flex flex-wrap">
        <div class="p-4 flex flex-col h-full sm:p-7">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                {{ $room_name }}
                @if($status)
                    {{-- TODO status available for room to book it today --}}
                    <span class="block  accent-green-600"></span>
                @else
                    <span class="accent-red-600"></span>
                @endif
            </h3>
            <p class="mt-1 text-gray-300 dark:text-neutral-200">
            <ul class="text-gray-300">
                <li>Superficie : {{ $area }} m²</li>
                <li>Nombre de personnes : {{ $nb_person }}</li>
            </ul>
            </p>
            <div class="mt-5 sm:mt-auto">
                <p class="text-xs text-gray-500 dark:text-neutral-500">
                    {{ $room_description }}
                </p>
            </div>
        </div>
    </div>
</div>
