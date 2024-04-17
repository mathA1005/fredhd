<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des équipements</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Assurez-vous d'avoir un fichier CSS approprié -->
</head>
<body>
<div class="container">
    <h1>Liste des Équipements</h1>
    @if($equipements->isEmpty())
        <p>Aucun équipement trouvé.</p>
    @else
        <ul>
            @foreach ($equipements as $equipement)
                <li>{{ $equipement->nom }}</li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
