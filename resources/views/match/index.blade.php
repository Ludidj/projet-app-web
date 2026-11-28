
@extends('layouts.app')

@section('title', __('interface.matches_title'))

@section('content')

    <h1>{{ __('interface.matches_heading') }}</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($matchs->isEmpty())
        <p>{{ __('interface.matches_empty') }}</p>
    @else

        @foreach ($matchs as $match)

            <div>
              <h2>{{ __('interface.matchup', [
                  'home' => $match->equipe?->nom ?? __('interface.unknown_team'),
                  'away' => $match->adversaire?->nom ?? __('interface.unknown_opponent'),
              ]) }}</h2>

                <p>{{ __('interface.match_date', ['date' => $match->date?->format('d/m/Y')]) }}</p>
                <p>{{ __('interface.match_time', ['time' => substr((string) $match->heure, 0, 5)]) }}</p>
                <p>{{ __('interface.match_location', ['location' => $match->Lieu]) }}</p>

                @if ($match->statut === 'annule')
                    <p>{{ __('interface.match_status') }} : {{ __('interface.cancelled') }}</p>
                @else
                    <p>{{ __('interface.match_status') }} : {{ __('interface.upcoming') }}</p>
                @endif

                

                @if (auth()->user()?->role === \App\Models\User::ROLE_MANAGER)
                    <a href="{{ route('match.edit', $match->idMatch) }}">
                        {{ __('interface.edit_match_status') }}
                    </a>
                @endif

            </div>

            <hr>

        @endforeach

    @endif

@endsection
