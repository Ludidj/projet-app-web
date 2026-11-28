<article>
    <h1>{{ $equipe->nom }}</h1>
    <p>{{ __('interface.team_id', ['id' => $equipe->idEquipe]) }}</p>
    <p>{{ __('interface.sport') }} : {{ $equipe->sport->nomSport }}</p>
    <p>{{ __('interface.division_number', ['division' => $equipe->Division]) }}</p>
</article>

<p>
    <a href="{{ route('equipe.edit', $equipe) }}">{{ __('interface.edit') }}</a>
</p>

<form method="post" action="{{ route('equipe.destroy', $equipe) }}">
    @csrf
    @method('DELETE')
    <button type="submit">{{ __('interface.delete') }}</button>
</form>

@if ($equipe->image_path)
    <img
        src="{{ asset('storage/' . $equipe->image_path) }}"
        alt="{{ $equipe->nom }}"
        style="max-width: 300px; height: auto;"
    >
@endif

<h2>{{ __('interface.players') }}</h2>

@forelse ($equipe->joueurs as $joueur)
    <article>
        <h3>{{ $joueur->nom }} {{ $joueur->{'prénom'} }}</h3>
        <p>{{ __('interface.number') }} : {{ $joueur->numero }}</p>
        <p>{{ __('interface.age_years', ['age' => $joueur->age]) }}</p>
        <p>{{ __('interface.sex') }} : {{ $joueur->sexe }}</p>
    </article>
@empty
    <p>{{ __('interface.players_empty') }}</p>
@endforelse
<p>
    <a href="{{ route('equipe.index') }}">{{ __('interface.return_teams') }}</a>
</p>
