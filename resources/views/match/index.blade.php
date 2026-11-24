
@extends('layouts.app')

@section('title', 'Liste des matchs')

@section('content')

    <h1>Les matchs</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($matchs->isEmpty())
        <p>Aucun match prévu pour le moment.</p>
    @else

        @foreach ($matchs as $match)

            <div>
              <h2>
  Les  {{ $match->equipe?->nom ?? 'Équipe inconnue' }}
    contre Les
    {{ $match->adversaire?->nom ?? 'Équipe inconnue' }}
</h2> 

                <p>Date : {{ $match->date?->format('d/m/Y') }}</p>
                <p>Heure : {{ $match->heure }}</p>
                <p>Lieu : {{ $match->Lieu }}</p>

                @if ($match->statut === 'annule')
                    <p>Statut : Annulé</p>
                @else
                    <p>Statut : À venir</p>
                @endif

                <a href="{{ route('match.show', $match->idMatch) }}">
                    Voir le match
                </a>

                @if (auth()->user()?->role === \App\Models\User::ROLE_MANAGER)
                    <a href="{{ route('match.edit', $match->idMatch) }}">
                        Modifier le statut
                    </a>
                @endif

            </div>

            <hr>

        @endforeach

    @endif

@endsection
