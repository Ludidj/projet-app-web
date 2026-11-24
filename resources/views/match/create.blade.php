
@extends('layouts.app')

@section('title', 'Ajouter un match')

@section('content')

    <h1>Ajouter un match</h1>

<form method="GET" action="{{ route('match.create') }}">

    <label for="idSport">Sport</label>

    <select id="idSport" name="idSport" onchange="this.form.submit()">
        <option value="">-- Choisir un sport --</option>

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

        <label for="idEquipe">Mon équipe</label>

        <select id="idEquipe" name="idEquipe">
            <option value="">-- Choisir une équipe --</option>

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

        <label for="idAdversaire">Équipe adverse</label>

        <select id="idAdversaire" name="idAdversaire">
            <option value="">-- Choisir l'équipe adverse --</option>

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

        <label for="date">Date du match</label>

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

        <label for="heure">Heure</label>

        <input
            type="time"
            id="heure"
            name="heure"
            value="{{ old('heure') }}"
        >

        @error('heure')
            <p>{{ $message }}</p>
        @enderror

        <label for="Lieu">Lieu</label>

        <input
            type="text"
            id="Lieu"
            name="Lieu"
            value="{{ old('Lieu') }}"
        >

        @error('Lieu')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Ajouter le match</button>

    </form>

@endsection
