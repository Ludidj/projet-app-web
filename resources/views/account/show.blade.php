@extends('layouts.app')

@section('content')
    <h1>Mon compte : {{ $user->name }}</h1>

    <p>vous avez créer {{ $equipes->count() }} equipes</p>

    @forelse ($equipes as $equipe)
        <p>{{ $equipe->nom }}</p>

        @can('update', $equipe)
            <a href="{{ route('equipe.edit', $equipe) }}">Modifier</a>
        @endcan

        @can('delete', $equipe)
            <form method="post" action="{{ route('equipe.destroy', $equipe) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        @endcan

    @empty
        <p>Aucune équipe.</p>
    @endforelse
@endsection