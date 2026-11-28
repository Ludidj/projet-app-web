
@extends('layouts.app')

@section('title', __('interface.add_match_title'))

@section('content')

    <h1>{{ __('interface.add_match_title') }}</h1>

<form method="GET" action="{{ route('match.create') }}">

    <label for="idSport">{{ __('interface.sport') }}</label>

    <select id="idSport" name="idSport" onchange="this.form.submit()">
        <option value="">{{ __('interface.choose_sport') }}</option>

        @foreach ($sports as $sport)
            <option
                value="{{ $sport->idSports }}"
                @selected(request('idSport') == $sport->idSports)
            >
                {{ $sport->nomSport }}
            </option>
        @endforeach
    </select>

</form>

    @error('idSport')
        <p>{{ $message }}</p>
    @enderror

    {{-- Ajouter le match --}}
    <form method="POST" action="{{ route('match.store') }}">
        @csrf

        <input type="hidden" name="idSport" value="{{ request('idSport') }}">

        <label for="idEquipe">{{ __('interface.my_team_label') }}</label>

        <select id="idEquipe" name="idEquipe">
            <option value="">{{ __('interface.choose_team') }}</option>

            @foreach ($equipes as $equipe)
                <option
                    value="{{ $equipe->idEquipe }}"
                    @selected(old('idEquipe') == $equipe->idEquipe)
                >
                    {{ $equipe->nom }}
                </option>
            @endforeach
        </select>

        @error('idEquipe')
            <p>{{ $message }}</p>
        @enderror

        <label for="idAdversaire">{{ __('interface.opponent_label') }}</label>

        <select id="idAdversaire" name="idAdversaire">
            <option value="">{{ __('interface.choose_opponent') }}</option>

            @foreach ($equipes as $equipe)
                <option
                    value="{{ $equipe->idEquipe }}"
                    @selected(old('idAdversaire') == $equipe->idEquipe)
                >
                    {{ $equipe->nom }}
                </option>
            @endforeach
        </select>

        @error('idAdversaire')
            <p>{{ $message }}</p>
        @enderror

        <label for="date">{{ __('interface.match_date_label') }}</label>

        <input
            type="date"
            id="date"
            name="date"
            value="{{ old('date') }}"
            min="{{ date('Y-m-d') }}"
        >

        @error('date')
            <p>{{ $message }}</p>
        @enderror

        <label for="heure">{{ __('interface.time') }}</label>

        <input
            type="time"
            id="heure"
            name="heure"
            value="{{ old('heure') }}"
        >

        @error('heure')
            <p>{{ $message }}</p>
        @enderror

        <label for="Lieu">{{ __('interface.location') }}</label>

        <input
            type="text"
            id="Lieu"
            name="Lieu"
            value="{{ old('Lieu') }}"
        >

        @error('Lieu')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">{{ __('interface.add_match_submit') }}</button>

    </form>

@endsection
