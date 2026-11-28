
@extends('layouts.app')

@section('title', __('interface.match_details_title'))

@section('content')

    <h1>{{ __('interface.match_details_title') }}</h1>

    <p>{{ __('interface.my_team') }} : {{ $match->equipe?->nom ?? __('interface.unknown_team') }}</p>
    <p>{{ __('interface.opposing_team') }} : {{ $match->idAdversaire }}</p>
    <p>{{ __('interface.match_date', ['date' => $match->date?->format('d/m/Y')]) }}</p>
    <p>{{ __('interface.match_time', ['time' => substr((string) $match->heure, 0, 5)]) }}</p>
    <p>{{ __('interface.match_location', ['location' => $match->Lieu]) }}</p>

    @if ($match->statut === 'annule')
        <p>{{ __('interface.match_status') }} : {{ __('interface.cancelled') }}</p>
    @else
        <p>{{ __('interface.match_status') }} : {{ __('interface.upcoming') }}</p>
    @endif

    <a href="{{ route('match.index') }}">{{ __('interface.return_matches') }}</a>

@endsection
