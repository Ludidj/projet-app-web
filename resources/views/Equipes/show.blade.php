<article>
    <h1>{{ $equipe->nom }}</h1>
    <p>Identifiant : {{ $equipe->idEquipe }}</p>
    <p>Sport : {{ $equipe->idSport }}</p>
    <p>Division : {{ $equipe->Division }}</p>
</article>

<p>
    <a href="{{ route('equipe.edit', $equipe) }}">Modifier</a>
</p>

<form method="post" action="{{ route('equipe.destroy', $equipe) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer</button>
</form>

@if ($equipe->image_path)
    <img
        src="{{ asset('storage/' . $equipe->image_path) }}"
        alt="{{ $equipe->nom }}"
        style="max-width: 300px; height: auto;"
    >
@endif
<h2>Joueurs</h2>

@forelse ($equipe->joueurs as $joueur)
    <article>
        <h3>{{ $joueur->nom }} {{ $joueur->{'prénom'} }}</h3>
        <p>Numéro : {{ $joueur->numero }}</p>
        <p>Âge : {{ $joueur->age }}</p>
        <p>Sexe : {{ $joueur->sexe }}</p>
    </article>
@empty
    <p>Aucun joueur dans cette équipe.</p>
@endforelse

<p>
    <a href="{{ route('equipe.index') }}">Retour aux équipes</a>
</p>