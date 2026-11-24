
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Equipes')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
        <a href="{{ route('account.show') }}">Mon compte</a>

        <a href="{{ route('match.index') }}">Matchs</a>

        @if (auth()->user()->role === \App\Models\User::ROLE_MANAGER)
            <a href="{{ route('match.create') }}">Ajouter un match</a>
        @endif

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </nav>
@else
    <nav>
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}">Inscription</a>
    </nav>
@endauth

<main>
    @yield('content')
</main>

<form method="post" action="{{ route('locale.update') }}">
    @csrf
    <label for="locale">Langue</label>
    <select id="locale" name="locale">
        <option value="fr" @selected(app()->getLocale() === 'fr')>Français</option>
        <option value="en" @selected(app()->getLocale() === 'en')>English</option>
    </select>
    <button type="submit">Appliquer</button>
</form>

</body>
</html>
