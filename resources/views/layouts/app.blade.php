
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('interface.teams'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    @stack('scripts')

    <style>
        nav {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px;
        }

        nav form {
            display: flex;
            align-items: center;
            gap: 15px;
        }
    </style>
</head>
<body>

@auth
    <nav>
        <a href="{{ route('account.show') }}">{{ __('interface.account') }}</a>
        <a href="{{ route('sports.index') }}">{{ __('interface.sports') }}</a>

        @if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
            <a href="{{ route('joueurs.create') }}">{{ __('interface.create_player') }}</a>
        @endif

        <a href="{{ route('match.index') }}">{{ __('interface.matches') }}</a>

        @if (auth()->user()->role === \App\Models\User::ROLE_MANAGER)
            <a href="{{ route('match.create') }}">{{ __('interface.add_match') }}</a>
        @endif

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">{{ __('interface.logout') }}</button>
        </form>
    </nav>
@else
    <nav>
        <a href="{{ route('sports.index') }}">{{ __('interface.sports') }}</a>
        <a href="{{ route('login') }}">{{ __('interface.login') }}</a>
        <a href="{{ route('register') }}">{{ __('interface.register') }}</a>
    </nav>
@endauth

<main>
    @yield('content')
</main>

</body>
</html>
