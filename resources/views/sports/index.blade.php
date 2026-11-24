@extends('layouts.app')

@section('title', 'Liste des sports')

@section('content')

    <h1>Liste des sports</h1>

    <a href="{{ route('sports.create') }}"
       style="display: inline-block; padding: 10px 20px; background-color: #282d41; color: white; text-decoration: none; border-radius: 6px; margin-bottom: 20px;">
        Créer un sport
    </a>

    @forelse ($sports as $sport)
        <div>
            <h2>{{ $sport->nomSport }}</h2>
            <p>{{ $sport->description }}</p>
        </div>
    @empty
        <p>Aucun sport enregistré.</p>
    @endforelse

@endsection