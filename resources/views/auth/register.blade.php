@extends('layouts.app')

@section('title', __('interface.register_title'))
@section('content')

<h1>{{ __('interface.register_title') }}</h1>

<form method="post" action="{{ route('register.store')  }}">

@csrf 

<label for="name">{{ __('interface.name') }}</label>
<input id= "name" name = "name" type="text" value="{{ old('name') }}" required>
 @error('name') <p>{{ $message }}</p> @enderror

        <label for="email">{{ __('interface.email') }}</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        @error('email') <p>{{ $message }}</p> @enderror

        <label for="email_confirmation">{{ __('interface.confirm_email') }}</label>
        <input id="email_confirmation" name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required>

        <label for="password">{{ __('interface.password') }}</label>
        <input id="password" name="password" type="password" required>
        @error('password') <p>{{ $message }}</p> @enderror

        <label for="password_confirmation">{{ __('interface.confirm_password') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required>


<div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
@error('g-recaptcha-response') <p>{{ $message }}</p> @enderror



        <button type="submit">{{ __('interface.register_submit') }}</button>
    </form>

@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

