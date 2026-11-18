<h1>Créer un joueur</h1>

<p>Équipe : {{ $equipe->nom }}</p>

<form method="POST" action="{{ route('joueurs.store', $equipe->idEquipe) }}">
    @csrf

    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Prénom</label>
    <input type="text" name="prénom" required>

    <label>Numéro</label>
    <input type="number" name="numero" required>

    <label>Âge</label>
    <input type="number" name="age" required>

    <label>Sexe</label>
    <input type="text" name="sexe" required>

    <button type="submit">Créer le joueur</button>
</form>

<a href="{{ route('equipe.show', $equipe->idEquipe) }}">Retour à l'équipe</a>