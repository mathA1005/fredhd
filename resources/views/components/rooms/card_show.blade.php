<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie Photo d'Hôtel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes slide {
            0% { transform: translateX(0); }
            20% { transform: translateX(0); }
            25% { transform: translateX(-100%); }
            45% { transform: translateX(-100%); }
            50% { transform: translateX(-200%); }
            70% { transform: translateX(-200%); }
            75% { transform: translateX(-300%); }
            95% { transform: translateX(-300%); }
            100% { transform: translateX(0); }
        }

        .carousel {
            animation: slide 16s infinite;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <div class="flex flex-wrap -mx-4">
        <!-- Galerie de photos -->
        <div class="w-full md:w-2/3 px-4 overflow-hidden">
            <div class="flex w-[400%] carousel">
                <div class="w-full md:w-1/4">
                    <img src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                </div>
                <div class="w-full md:w-1/4">
                    <img src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                </div>
                <div class="w-full md:w-1/4">
                    <img src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                </div>
                <div class="w-full md:w-1/4">
                    <img src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
                </div>
            </div>
        </div>
        <!-- Informations sur les chambres -->
        <div class="w-full md:w-1/3 px-4 mt-4 md:mt-0">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Informations sur les chambres</h2>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Chambre 1</h3>
                    <p class="text-gray-700">Description de la chambre 1. Cette chambre dispose de toutes les commodités nécessaires pour un séjour confortable.</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Chambre 2</h3>
                    <p class="text-gray-700">Description de la chambre 2. Idéale pour les voyageurs qui cherchent un endroit tranquille pour se reposer.</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Chambre 3</h3>
                    <p class="text-gray-700">Description de la chambre 3. Offrant une vue imprenable et des équipements modernes.</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Chambre 4</h3>
                    <p class="text-gray-700">Description de la chambre 4. Confort et style réunis pour un séjour de rêve.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
