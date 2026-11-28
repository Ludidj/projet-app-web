@extends('layouts.app')

@section('title', __('interface.player_create_title'))

@section('content')

    <h1>{{ __('interface.player_create_title') }}</h1>

    <p>{{ __('interface.player_available_notice') }}</p>

    @if (session('status'))
        <p role="status">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('joueurs.store') }}">
        @csrf

        <label for="nom">{{ __('interface.name') }}</label>
        <input id="nom" type="text" name="nom" required>

        <label for="prénom">{{ __('interface.first_name') }}</label>
        <input id="prénom" type="text" name="prénom" required>

        
        <label for="email">{{ __('interface.email') }}</label>
<input
    type="email"
    id="email"
    name="email"
    value="{{ old('email') }}"
    required
>

        <label for="numero">{{ __('interface.number') }}</label>
        <input id="numero" type="number" name="numero" required>

        <label for="age">{{ __('interface.age') }}</label>
        <input id="age" type="number" name="age" required>

        <label for="sexe">{{ __('interface.sex') }}</label>
        <input id="sexe" type="text" name="sexe" required>
         <option value="">{{ __('interface.sex_options') }}</option>

        <button type="submit">{{ __('interface.player_create_submit') }}</button>
    </form>
@endsection
