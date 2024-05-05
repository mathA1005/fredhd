@extends('layouts.main')

@section('content')

    <section class="header">
        <x-home.header/>
        <h1>Bienvenue Chez FredHouseDurbuy</h1>
        <span>Deux chambres d’hôtes de charme à la campagne en Ardennes belge</span>
        <a href="{{ route('about.index') }}">Notre maison</a>
    </section>
    <section class="rooms">
        <x-home.rooms/>
    </section>
    <section class="testimonials">
        <x-home.testimonials/>
    </section>
@endsection
