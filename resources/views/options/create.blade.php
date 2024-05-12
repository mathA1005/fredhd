<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un équipement</title>
</head>
<body>
<div class="container">
    <h1>Ajouter un nouvel équipement</h1>
    <form method="POST" action="{{ route('options.store') }}">
        @csrf
        <label for="icon">Nom de l'équipement:</label>
        <input type="text" id="icon" name="icon" required>

        <label for="label">Description:</label>
        <textarea id="label" name="label" required></textarea>

        <button type="submit">Ajouter</button>
    </form>
</div>
</body>
</html>
