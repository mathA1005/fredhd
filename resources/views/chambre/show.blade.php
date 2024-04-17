<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $chambre->nom }}</title>
</head>
<body>
<h1>{{ $chambre->nom }}</h1>
<p>Description: {{ $chambre->description }}</p>
<img src="{{ Storage::url($chambre->photo) }}" alt="Photo de la chambre {{ $chambre->nom }}">
<!-- Vous pouvez ajouter plus de détails ici selon les attributs disponibles dans votre modèle Chambre -->
</body>
</html>
