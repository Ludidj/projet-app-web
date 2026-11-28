@extends('layouts.app')

@section('title', __('interface.login_title'))

@section('content')
    <h1>{{ __('interface.login_title') }}</h1>

    <form method="post" action="{{ route('login.store') }}">
        @csrf
        <label for="email">{{ __('interface.email') }}</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        @error('email') <p>{{ $message }}</p> @enderror

        <label for="password">{{ __('interface.password') }}</label>
        <input id="password" name="password" type="password" required>

        <button type="submit">{{ __('interface.login_submit') }}</button>
    </form>
@endsection
