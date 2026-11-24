
@extends('layouts.app')

@section('title', 'Détails du match')

@section('content')

    <h1>Détails du match</h1>

    <p>Mon équipe : {{ $match->equipe?->nom ?? 'Équipe inconnue' }}</p>
    <p>Équipe adverse : {{ $match->idAdversaire }}</p>
    <p>Date : {{ $match->date?->format('d/m/Y') }}</p>
    <p>Heure : {{ $match->heure }}</p>
    <p>Lieu : {{ $match->Lieu }}</p>

    @if ($match->statut === 'annule')
        <p>Statut : Annulé</p>
    @else
        <p>Statut : À venir</p>
    @endif

    <a href="{{ route('match.index') }}">Retour aux matchs</a>

@endsection
