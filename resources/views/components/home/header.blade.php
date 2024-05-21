<!-- Slider -->
<div data-hs-carousel='{
    "items": 1,
    "loop": true,
    "autoplay": true,
    "autoplayTimeout": 5000,
    "autoplayHoverPause": true,
    "navButtons": true,
    "pagination": true
  }' class="relative">
    <div class="hs-carousel relative overflow-hidden w-full min-h-96 bg-white rounded-lg">
        <div class="hs-carousel-body absolute top-0 bottom-0 left-0 flex flex-nowrap transition-transform duration-700 opacity-100">
            <!-- Slide 1 -->
            <div class="hs-carousel-slide flex justify-center items-center h-full">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/picture/IMG_20230514_174052.jpg') }}" alt="Slide 1">
                <div class="relative z-10 p-6 text-center">
                    <h1 class="text-3xl font-bold mb-4 text-white">Bienvenue Chez FredHouseDurbuy</h1>
                    <span class="block mb-4 text-white">Deux chambres d’hôtes de charme à la campagne en Ardennes belge</span>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="hs-carousel-slide flex justify-center items-center h-full">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/picture/IMG_20230514_174052.jpg') }}" alt="Slide 2">
                <div class="relative z-10 p-6 text-center">
                    <h1 class="text-3xl font-bold mb-4 text-white">Bienvenue Chez FredHouseDurbuy</h1>
                    <span class="block mb-4 text-white">Deux chambres d’hôtes de charme à la campagne en Ardennes belge</span>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="hs-carousel-slide flex justify-center items-center h-full">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/picture/IMG_20230514_174052.jpg') }}" alt="Slide 3">
                <div class="relative z-10 p-6 text-center">
                    <h1 class="text-3xl font-bold mb-4 text-white">Bienvenue Chez FredHouseDurbuy</h1>
                    <span class="block mb-4 text-white">Deux chambres d’hôtes de charme à la campagne en Ardennes belge</span>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 left-0 flex justify-center items-center w-[46px] h-full text-white hover:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10">
        <span class="text-2xl" aria-hidden="true">
            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </span>
        <span class="sr-only">Previous</span>
    </button>
    <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 right-0 flex justify-center items-center w-[46px] h-full text-white hover:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10">
        <span class="sr-only">Next</span>
        <span class="text-2xl" aria-hidden="true">
            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </span>
    </button>

    <div class="hs-carousel-pagination flex justify-center absolute bottom-3 left-0 right-0 space-x-2">
        <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 w-3 h-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"></span>
        <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 w-3 h-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"></span>
        <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 w-3 h-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"></span>
    </div>
</div>
<!-- End Slider -->
