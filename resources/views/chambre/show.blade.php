@extends('layouts.main')
@section('content')

    <x-rooms.card_show/>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->label }}</title>
</head>
<body>
<h1>{{ $room->label }}</h1>
<p>Description: {{ $room->description }}</p>
<img src="{{ Storage::url($room->picture) }}" alt="Photo de la chambre {{ $room->picture }}">
<!-- Vous pouvez ajouter plus de détails ici selon les attributs disponibles dans votre modèle Room -->
</body>
</html>
@endsection
