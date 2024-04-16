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
</body>
</html>
