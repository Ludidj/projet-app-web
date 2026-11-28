@extends('layouts.app')

@section('title', __('interface.sports_title'))

@section('content')

    <h1>{{ __('interface.sports_title') }}</h1>

    @auth
        @if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
            <p><a href="{{ route('sports.create') }}">{{ __('interface.add_sport') }}</a></p>
        @endif
    @endauth

    @forelse ($sports as $sport)
        <div>
            <h2><a href="{{ route('sports.show', $sport->idSports) }}">{{ $sport->nomSport }}</a></h2>
            <p>{{ $sport->description }}</p>
            <p>{{ __('interface.teams_count', ['count' => $sport->equipes_count]) }}</p>
        </div>
    @empty
        <p>{{ __('interface.sports_empty') }}</p>
    @endforelse

@endsection
