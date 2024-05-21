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

    <section class="testimonials">
        <x-home.testimonials/>
    </section>

@endsection
