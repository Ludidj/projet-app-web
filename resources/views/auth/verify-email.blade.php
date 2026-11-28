@extends('layouts.app')

@section('title', __('interface.email_verification_title'))

@section('content')
    <h1>{{ __('interface.email_verification_title') }}</h1>
    <p>{{ __('interface.email_verification_sent') }}</p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form method="post" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">{{ __('interface.resend_link') }}</button>
    </form>
@endsection
