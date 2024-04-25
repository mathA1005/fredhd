{{-- resources/views/reservations/index.blade.php --}}
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réservations</title>
</head>
<body>
<h1>Liste des Réservations</h1>
<table>
    <thead>
    <tr>
        <th>ID Chambre</th>
        <th>Nom Chambre</th>
        <th>Utilisateur</th>
        <th>Date de Début</th>
        <th>Date de Fin</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->chambre->id ?? 'ID non disponible' }}</td>
            <td>{{ $reservation->chambre->name ?? 'Chambre non spécifiée' }}</td>
            <td>{{ $reservation->user->name }}</td>
            <td>{{ $reservation->start_date ? $reservation->start_date->format('Y-m-d') : 'Date non disponible' }}</td>
            <td>{{ $reservation->end_date ? $reservation->end_date->format('Y-m-d') : 'Date non disponible' }}</td>
        </tr>
    @endforeach


    </tbody>
</table>
</body>
</html>
