@extends('layouts.main')
@section('content')
    <body class="bg-gray-800">
    <div class="overflow-hidden bg-gray-800 rounded-xl shadow-md dark:bg-neutral-900">
        <div class="relative max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Title -->
            <div class="max-w-2xl w-3/4 lg:w-1/2 mb-6 sm:mb-10 md:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl text-white font-semibold">
Laisser nous un commentaire                </h2>
            </div>
            <!-- End Title -->

            @if(session('success'))
                <p class="text-white">{{ session('success') }}</p>
            @endif

            @if(auth()->check())
                <form action="{{ route('reviews.store') }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="comment" required class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Votre avis"></textarea>
                    <button type="submit" class="mt-2 p-2 bg-blue-600 rounded text-white">Ajouter un avis</button>
                </form>
            @else
                <p class="text-white mb-6">Vous devez être connecté pour laisser un avis.</p>
        @endif

        <!-- Carousel -->
            <div x-data="{ currentSlide: 0, slides: @json($reviews) }" class="relative w-full overflow-hidden">
                <!-- Slides -->
                <template x-for="(review, index) in slides" :key="index">
                    <div x-show="currentSlide === index" class="flex h-auto items-center justify-center transition-transform duration-500">
                        <div class="flex flex-col rounded-xl shadow-md bg-customGreen w-full min-h-[200px]">
                            <div class="flex-auto p-4 md:p-6 flex items-center justify-center">
                                <p class="text-base italic md:text-lg text-gray-800 dark:text-neutral-200 text-center">
                                    "<span x-text="review.comment"></span>"
                                </p>
                            </div>
                            <div class="p-4 bg-gray-100 rounded-b-xl md:px-7 dark:bg-neutral-800">
                                <div class="flex items-center justify-center">
                                    <div class="grow ml-3 text-center">
                                        <p class="text-sm sm:text-base font-semibold text-gray-800 dark:text-neutral-200">
                                            <span x-text="review.user.name"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Controls -->
                <button @click="currentSlide = (currentSlide - 1 + slides.length) % slides.length" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full">
                    &#9664;
                </button>
                <button @click="currentSlide = (currentSlide + 1) % slides.length" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full">
                    &#9654;
                </button>
            </div>
            <!-- End Carousel -->
        </div>
    </div>
    </body>
@endsection
