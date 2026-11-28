@extends('layouts.app')

@section('content')
    <h1>{{ __('interface.access_denied') }}</h1>
    <p>{{ __('interface.permission_denied') }}</p>
    <a href="{{ route('home') }}">{{ __('interface.return_home') }}</a>
@endsection
