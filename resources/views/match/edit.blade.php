
@extends('layouts.app')

@section('title', 'Modifier le statut')

@section('content')

    <h1>Modifier le statut du match</h1>

    <p>
        Équipe : {{ $match->equipe?->nom ?? 'Équipe inconnue' }}
    </p>

    <p>Date : {{ $match->date?->format('d/m/Y') }}</p>

    <form method="POST" action="{{ route('match.update', $match->idMatch) }}">
        @csrf
        @method('PUT')

        <label for="statut">Statut du match</label>

        <select id="statut" name="statut">
            <option value="a_venir" @selected(old('statut', $match->statut) === 'a_venir')>
                À venir
            </option>

            <option value="annule" @selected(old('statut', $match->statut) === 'annule')>
                Annulé
            </option>
        </select>

        @error('statut')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('match.index') }}">Retour aux matchs</a>

@endsection
