@extends('layouts.app')

@section('title', __('interface.logout'))

@section('content')
    <h1>{{ __('interface.logout_confirm_title') }}</h1>

    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit">{{ __('interface.logout') }}</button>
        <a href="{{ route('home') }}">{{ __('interface.cancel') }}</a>
    </form>
@endsection
