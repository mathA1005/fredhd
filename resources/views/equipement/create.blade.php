<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un équipement</title>
</head>
<body>
<div class="container">
    <h1>Ajouter un nouvel équipement</h1>
    <form method="POST" action="{{ route('equipements.store') }}">
        @csrf
        <label for="nom">Nom de l'équipement:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Ajouter</button>
    </form>
</div>
</body>
</html>
