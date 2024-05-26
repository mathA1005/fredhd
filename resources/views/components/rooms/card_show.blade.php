@props(['room', 'roomOptions', 'roomPictures'])

<div class="max-w-4xl mx-auto py-10 bg-white rounded-xl border border-gray-200 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 my-4 mx-2">
    <div class="p-4 rounded-xl">
        <!-- Carrousel d'images -->
        <div class="relative w-full mb-6">
            <div class="carousel-images overflow-hidden rounded-xl">
                @foreach($roomPictures as $index => $picture)
                    <img class="carousel-image w-full object-cover max-h-128 mb-4 {{ $index !== 0 ? 'hidden' : '' }}" src="{{ Storage::url($picture->path) }}" alt="Photo supplémentaire {{ $index + 1 }}">
                @endforeach
            </div>
            <button class="carousel-control-prev absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-control-next absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full" onclick="nextSlide()">&#10095;</button>
        </div>

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

        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500" href="{{ route('reservation.show', ['id' => $room->id]) }}">Réservez la chambre</a>
    </div>
</div>

<script>
    let currentSlide = 0;

    function showSlide(index) {
        const slides = document.querySelectorAll('.carousel-image');
        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;
        slides.forEach((slide, i) => {
            slide.classList.toggle('hidden', i !== currentSlide);
        });
    }

    function nextSlide() {
        currentSlide++;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide--;
        showSlide(currentSlide);
    }
</script>
