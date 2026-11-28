
@extends('layouts.app')

@section('title', __('interface.edit_match_status'))

@section('content')

    <h1>{{ __('interface.edit_match_status_title') }}</h1>

    <p>
        {{ __('interface.team') }} : {{ $match->equipe?->nom ?? __('interface.unknown_team') }}
    </p>

    <p>{{ __('interface.match_date', ['date' => $match->date?->format('d/m/Y')]) }}</p>

    <form method="POST" action="{{ route('match.update', $match->idMatch) }}">
        @csrf
        @method('PUT')

        <label for="statut">{{ __('interface.match_status') }}</label>

        <select id="statut" name="statut">
            <option value="a_venir" @selected(old('statut', $match->statut) === 'a_venir')>
                {{ __('interface.upcoming') }}
            </option>

            <option value="annule" @selected(old('statut', $match->statut) === 'annule')>
                {{ __('interface.cancelled') }}
            </option>
        </select>

        @error('statut')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">{{ __('interface.save_changes') }}</button>
    </form>

    <a href="{{ route('match.index') }}">{{ __('interface.return_matches') }}</a>

@endsection
