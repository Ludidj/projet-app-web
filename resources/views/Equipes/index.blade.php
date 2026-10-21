 <h1>Équipes</h1>

@forelse ($equipes as $equipe)
    <article>
        <h2><a href="{{ route('equipe.show', $equipe) }}">{{ $equipe->nom }}</a></h2>
    </article>
@empty
    <p>Aucune équipe enregistrée.</p>
@endforelse

{{ $equipes->links() }}