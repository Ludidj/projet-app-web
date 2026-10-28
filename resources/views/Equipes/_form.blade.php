@csrf

<label for="idSport">Sport</label>
<select id="idSport" name="idSport">
    <option value="">-- Choisir un sport --</option>

    @foreach ($sports as $sport)
        <option
            value="{{ $sport->idSports }}"
            @selected(old('idSport', $equipe?->idSport) == $sport->idSports)
        >
            {{ $sport->nomSport }}
        </option>
    @endforeach
</select>

@error('idSport')
    <p>{{ $message }}</p>
@enderror

<label for="nom">Nom de l'équipe</label>
<input
    type="text"
    id="nom"
    name="nom"
    value="{{ old('nom', $equipe?->nom) }}"
>
@error('nom')
    <p>{{ $message }}</p>
@enderror

<label for="Division">Division</label>
<input
    type="number"
    id="Division"
    name="Division"
    value="{{ old('Division', $equipe?->Division) }}"
>
@error('Division')
    <p>{{ $message }}</p>
@enderror

<label for="image">Image</label>
<input id="image" name="image" type="file"
       accept="image/jpeg,image/png,image/webp">
@error('image')
    <p>{{ $message }}</p>
@enderror

<button type="submit">Enregistrer</button>