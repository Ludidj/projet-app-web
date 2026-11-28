
@extends('layouts.app')

@section('title', __('interface.sport_create_title'))

@section('content')

    <h1>{{ __('interface.sport_create_title') }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form action="{{ route('sports.store') }}" method="POST">
        @csrf

        <div>
            <label for="nomSport">{{ __('interface.sport') }}</label>
            <input
                type="text"
                name="nomSport"
                id="nomSport"
                value="{{ old('nomSport') }}"
            >

            @error('nomSport')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">{{ __('interface.description') }}</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>

            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">{{ __('interface.create_sport') }}</button>
    </form>

    <a href="{{ route('sports.index') }}">{{ __('interface.view_sports') }}</a>

@endsection
