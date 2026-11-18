
<h1>Créer un sport</h1>

@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<form action="{{ route('sports.store') }}" method="POST">
    @csrf

    <div>
        <label for="nomSport">Nom du sport</label>
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
        <label for="description">Description</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Créer le sport</button>
</form>

<a href="{{ route('sports.index') }}">Voir les sports</a>
