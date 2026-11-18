
<h1>Liste des sports</h1>

<a href="{{ route('sports.create') }}">Créer un sport</a>

@forelse ($sports as $sport)
    <div>
        <h2>{{ $sport->nomSport }}</h2>
        <p>{{ $sport->description }}</p>
    </div>
@empty
    <p>Aucun sport enregistré.</p>
@endforelse
