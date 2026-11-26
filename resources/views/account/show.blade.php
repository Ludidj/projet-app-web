
@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')

    <h1>Mon compte : {{ $user->name }}</h1>

    {{-- Manager --}}
    @if ($user->role === 'manager')

        <h2>Mes équipes créées</h2>

        <p>Vous avez créé {{ $equipes->count() }} équipes.</p>

        @forelse ($equipes as $equipe)

            <p>{{ $equipe->nom }}</p>

            @can('update', $equipe)
                <a href="{{ route('equipe.edit', $equipe) }}">Modifier</a>
            @endcan

            @can('delete', $equipe)
                <form method="POST" action="{{ route('equipe.destroy', $equipe) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            @endcan

        @empty
            <p>Aucune équipe.</p>
        @endforelse

    @endif

    {{-- Member / Joueur --}}
    @if ($user->role === 'member')

        <h2>Mes équipes</h2>

        @if ($equipeJoueur)

            <p>
                <a href="{{ route('equipe.show', $equipeJoueur->idEquipe) }}">
                    {{ $equipeJoueur->nom }}
                </a>
            </p>

        @else
            <p>Vous ne faites partie d'aucune équipe pour le moment.</p>
        @endif

    @endif

@endsection
