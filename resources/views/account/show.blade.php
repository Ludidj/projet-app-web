@extends('layouts.app')

@section('title', __('interface.account'))

@section('content')
    <h1>{{ __('interface.account_title', ['name' => $user->name]) }}</h1>

    @if ($user->role === \App\Models\User::ROLE_MEMBER)
        <h2>{{ __('interface.account_my_team') }}</h2>

        @if ($equipeJoueur)
            <p>
                <a href="{{ route('equipe.show', $equipeJoueur->idEquipe) }}">
                    {{ $equipeJoueur->nom }}
                </a>
                @if ($equipeJoueur->sport)
                    — {{ $equipeJoueur->sport->nomSport }}
                @endif
            </p>

            <h2>{{ __('interface.my_upcoming_matches') }}</h2>

            @forelse ($matchsAvenir as $match)
                @php
                    $adversaire = $match->idEquipe === $equipeJoueur->idEquipe
                        ? $match->adversaire
                        : $match->equipe;
                @endphp

                <article>
                    <p>{{ __('interface.versus', ['team' => $adversaire?->nom ?? __('interface.unknown_opponent')]) }}</p>
                    <p>{{ __('interface.match_date', ['date' => $match->date?->format('d/m/Y')]) }}</p>
                    <p>{{ __('interface.match_time', ['time' => substr((string) $match->heure, 0, 5)]) }}</p>
                    <p>{{ __('interface.match_location', ['location' => $match->Lieu]) }}</p>
                
                </article>
            @empty
                <p>{{ __('interface.no_upcoming_matches') }}</p>
            @endforelse
        @else
            <p>{{ __('interface.player_not_associated') }}</p>
        @endif
    @endif

    @if ($user->role === \App\Models\User::ROLE_ADMIN)
        <h2>{{ __('interface.my_creations') }}</h2>
        <p>{{ __('interface.players_created', ['count' => $statistiques['joueursCrees']]) }}</p>
        <p>{{ __('interface.sports_created', ['count' => $statistiques['sportsCrees']]) }}</p>
        <p>{{ __('interface.creation_tracking_note') }}</p>
    @endif

    @if ($user->role === \App\Models\User::ROLE_MANAGER)
        <h2>{{ __('interface.my_activity') }}</h2>
        <p>{{ __('interface.upcoming_matches_count', ['count' => $statistiques['matchsAvenir']]) }}</p>
        <p>{{ __('interface.cancelled_matches_count', ['count' => $statistiques['matchsAnnules']]) }}</p>
        <p>{{ __('interface.teams_created', ['count' => $statistiques['equipesCreees']]) }}</p>

        <h2>{{ __('interface.my_teams') }}</h2>

        @forelse ($equipes as $equipe)
            <article>
                <p>
                    <a href="{{ route('equipe.show', $equipe->idEquipe) }}">
                        {{ $equipe->nom }}
                    </a>
                </p>

              
            </article>
        @empty
            <p>{{ __('interface.no_teams_created') }}</p>
        @endforelse
    @endif
@endsection
