@extends('layouts.main')

@section('content')
    <section class="testimonials">
        <x-about.header/>
    </section>
    <div class="p-6">
        <div class="flex justify-center mb-4">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/FT-hxs14V8k?si=NwA1cSo7a5XyChrR"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
    <div class="container mx-auto bg-customGreen p-12 text-white rounded-lg">
        Fredhousedurbuy se situe dans le petit village de Heyd en bordure de forêt.
        À 8 km de Durbuy petite ville bien connue.
        A 3 km de Weris reconnue pour ses mégalithes.
        A 43 km du circuit Spa-Francorchamps.

        Fredhousedurbuy vous propose deux chambres d’hôtes à l’étage avec entrée indépendante .
        Chacune sa salle de bain douche évier wc.
        Télévision avec connexion wi-fi, Netflix YouTube…..
        Petit espace commun avec frigo machine à thé machine à café, vins à disposition…

        Vous pourrez profiter d’un grand jardin aménagé, d’une belle terrasse et d’un jacuzzi.
        Deux chevaux dans la propriété en guise de compagnie reposante ainsi qu’un chat et de nombreux oiseaux en
        liberté.

        Lors des repas, petit déjeuner et/ou repas du soir, possibilité de table d’hôtes, vous serez dans un espace
        intérieur cosy, déco fifties avec feu ouvert.

        Délicieux restaurants et nombreuses promenades dans les forêts ardennaises.

        Mon but est vous que vous passiez un moment agréable dans un cadre verdoyant calme harmonieux et que vous soyez
        choyé.
        Accompagné de bons moments culinaires dans une ambiance festive et agréable.

        Au plaisir de faire votre connaissance, à très vite 😊👍
    </div>
    <section class="testimonials">
        <x-about.gallery/>
    </section>

@endsection
