@extends('layouts.app')

@section('title', $sport->nomSport)

@section('content')
    <h1>{{ $sport->nomSport }}</h1>
    <p>{{ $sport->description }}</p>

    <h2>{{ __('interface.sport_teams_title') }}</h2>

    @forelse ($sport->equipes as $equipe)
        <article>
            <h3><a href="{{ route('equipe.show', $equipe) }}">{{ $equipe->nom }}</a></h3>
            <p>{{ __('interface.division_number', ['division' => $equipe->Division]) }}</p>

            @if ($equipe->image_path)
                <img
                    src="{{ asset('storage/' . $equipe->image_path) }}"
                    alt="Logo de {{ $equipe->nom }}"
                    width="120"
                    height="120"
                    loading="lazy"
                >
            @endif
        </article>
    @empty
        <p>{{ __('interface.sport_teams_empty') }}</p>
    @endforelse

    <p><a href="{{ route('sports.index') }}">{{ __('interface.return_sports') }}</a></p>
@endsection
