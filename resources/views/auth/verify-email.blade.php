@extends('layouts.app')

@section('title', 'Vérifier votre adresse courriel')

@section('content')
    <h1>Vérifiez votre adresse courriel</h1>
    <p>Un lien de vérification vous a été envoyé par courriel.</p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form method="post" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Renvoyer le lien</button>
    </form>
@endsection
