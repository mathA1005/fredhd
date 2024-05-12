@extends('layouts.main')

@section('content')
    <x-contact.form />
    <title>Carte Google Maps</title>
    <body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex flex-col lg:flex-row items-stretch justify-center w-full">
        <!-- Conteneur de la carte avec une hauteur maximale plus petite -->
        <div class="w-full lg:w-1/2 flex items-stretch max-h-72 lg:max-h-80">
            <iframe
                class="w-full h-full"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d325878.374161766!2d5.57126!3d50.349308!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0451ccd23c6e7%3A0x397238eaf03db8f6!2sBihay%2041%2C%206941%20Durbuy%2C%20Belgique!5e0!3m2!1sfr!2sus!4v1715534578892!5m2!1sfr!2sus"
            ></iframe>
        </div>
        <!-- Conteneur de l'image adjacente avec une hauteur maximale plus petite -->
        <div class="w-full lg:w-1/2 flex items-stretch max-h-72 lg:max-h-80 ">

            <img src="/storage/picture/IMG_20230514_174052.jpg" class="w-full h-full object-cover rounded-lg shadow-lg"/>
        </div>
    </div>
    </body>
@endsection
