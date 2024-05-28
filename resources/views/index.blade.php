@extends('layouts.main')

@section('content')

    <section class="header">
        <x-home.header/>
        <!-- Conteneur pour centrer la vidéo -->
        <div class="p-6">
            <div class="flex justify-center mb-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/FT-hxs14V8k?si=NwA1cSo7a5XyChrR"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section class="rooms">
        <x-home.rooms :rooms="$rooms"/>
    </section>


    <!-- Testimonials Section -->
    <div class="overflow-hidden bg-gray-800 rounded-xl shadow-md dark:bg-neutral-900">
        <div class="relative max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Title -->
            <div class="max-w-2xl w-3/4 lg:w-1/2 mb-6 sm:mb-10 md:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl text-white font-semibold">
                    Ce qu'ils en disent
                </h2>
            </div>
            <!-- End Title -->

            <!-- Carousel -->
            <div class="relative w-full h-full">
                <div class="carousel">
                    <input type="radio" name="carousel" id="carousel-1" checked>
                    <input type="radio" name="carousel" id="carousel-2">
                    <input type="radio" name="carousel" id="carousel-3">

                    <div class="carousel-inner">
                        @php
                            $reviewsArray = $reviews->toArray();
                            $chunks = array_chunk($reviewsArray, 3);
                        @endphp

                        @foreach($chunks as $index => $chunk)
                            <div class="carousel-item-group" id="group-{{ $index + 1 }}">
                            @foreach($chunk as $review)
                                <!-- Slide Item -->
                                    <div class="carousel-item flex h-auto items-center justify-center mx-2">
                                        <div class="flex flex-col rounded-xl shadow-md bg-customGreen w-full h-full min-h-[200px] max-h-[300px]">
                                            <div class="flex-auto p-4 md:p-6 flex items-center justify-center">
                                                <p class="text-base italic md:text-lg text-gray-800 dark:text-neutral-200 text-center">
                                                    "{{ $review['comment'] }}"
                                                </p>
                                            </div>
                                            <div class="p-4 bg-gray-100 rounded-b-xl md:px-7 dark:bg-neutral-800">
                                                <div class="flex items-center justify-center">
                                                    <div class="grow ml-3 text-center">
                                                        <p class="text-sm sm:text-base font-semibold text-gray-800 dark:text-neutral-200">
                                                            {{ $review['user']['name'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Slide Item -->
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Carousel -->
        </div>
    </div>

    <!-- CSS -->
    <style>
        .carousel {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            transition: transform 1s ease;
        }

        .carousel-item-group {
            display: flex;
            flex: 1 0 100%;
            justify-content: space-between;
        }

        .carousel-item {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0 10px; /* Adding space between items */
            height: 100%; /* Ensure all items have equal height */
        }

        .carousel-item > div {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 200px;
            max-height: 300px;
            height: 100%;
        }

        .carousel input {
            display: none;
        }

        #carousel-1:checked ~ .carousel-inner {
            transform: translateX(0%);
        }

        #carousel-2:checked ~ .carousel-inner {
            transform: translateX(-100%);
        }

        #carousel-3:checked ~ .carousel-inner {
            transform: translateX(-200%);
        }

        @keyframes carousel {
            0%, 20% { transform: translateX(0); }
            25%, 45% { transform: translateX(-100%); }
            50%, 70% { transform: translateX(-200%); }
            75%, 100% { transform: translateX(0); }
        }

        .carousel-inner {
            animation: carousel 15s infinite;
        }
    </style>


@endsection
