<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<h1>Chambres disponibles</h1>
@foreach ($chambres as $chambre)
    <div>
        <h2>{{ $chambre->nom }}</h2>
        <p>{{ $chambre->description }}</p>
        <img src="{{ $chambre->photo }}" alt="Photo de la chambre {{ $chambre->nom }}">

        <!-- Affichage des équipements liés à la chambre -->
        <ul>
            @foreach ($chambre->equipements as $equipement)
                <li>{{ $equipement->nom }}</li>
            @endforeach
        </ul>
    </div>
@endforeach
@foreach ($chambres as $chambre)
    <div class="p-4 hover:bg-gray-200">
        <h2 class="text-xl font-bold">
            <!-- Assurez-vous que le lien utilise 'id' pour passer l'identifiant -->
            <a href="{{ route('chambre.show', ['id' => $chambre->id]) }}">{{ $chambre->nom }}</a>
        </h2>
        <p>{{ Str::limit($chambre->description, 150) }}</p>
    </div>
@endforeach

</body>
</html>
