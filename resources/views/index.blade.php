@extends('layouts.main')

@section('content')

    <section class="header">
        <x-home.header/>

        <h1 class="text-center text-3xl font-bold mb-4">Bienvenue Chez FredHouseDurbuy</h1>
        <span class="block text-center mb-4">Deux chambres d’hôtes de charme à la campagne en Ardennes belge</span>

        <!-- Conteneur pour centrer la vidéo -->
        <div class="flex justify-center mb-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/FT-hxs14V8k?si=NwA1cSo7a5XyChrR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>

        <div class="text-center">
            <a href="{{ route('about.index') }}" class="text-blue-500 hover:underline">Notre maison</a>
        </div>
    </section>

    <section class="rooms">
        <x-home.rooms/>
    </section>

    <section class="testimonials">
        <x-home.testimonials/>
    </section>

@endsection
