<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Equipes')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('scripts')
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>

<form method="post" action="{{ route('locale.update') }}">
    @csrf
    <label for="locale">Langue</label>
    <select id="locale" name="locale">
        <option value="fr" @selected(app()->getLocale() === 'fr')>Français</option>
        <option value="en" @selected(app()->getLocale() === 'en')>English</option>
    </select>
    <button type="submit">Appliquer</button>
</form>

</html>
