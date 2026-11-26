@extends('layouts.app')

@section('title', 'Créer un joueur')

@section('content')

    <h1>Créer un joueur</h1>

    <p>Équipe : {{ $equipe->nom }}</p>

    <form method="POST" action="{{ route('joueurs.store', $equipe->idEquipe) }}">
        @csrf

        <label for="nom">Nom</label>
        <input id="nom" type="text" name="nom" required>

        <label for="prénom">Prénom</label>
        <input id="prénom" type="text" name="prénom" required>

        
        <label for="email">Courriel </label>
<input
    type="email"
    id="email"
    name="email"
    value="{{ old('email') }}"
    required
>

        <label for="numero">Numéro</label>
        <input id="numero" type="number" name="numero" required>

        <label for="age">Âge</label>
        <input id="age" type="number" name="age" required>

        <label for="sexe">Sexe</label>
        <input id="sexe" type="text" name="sexe" required>

        <button type="submit">Créer le joueur</button>
    </form>

    <a href="{{ route('equipe.show', $equipe->idEquipe) }}">Retour à l'équipe</a>

@endsection