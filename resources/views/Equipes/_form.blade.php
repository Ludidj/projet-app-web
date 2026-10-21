
@csrf

<label for="idSport">Sport</label>
<input type="number" id="idSport" name="idSport" value="{{ old('idSport', $equipe?->idSport) }}">
@error('idSport')
    <p>{{ $message }}</p>
@enderror

<label for="nom">Nom de l'équipe</label>
<input type="text" id="nom" name="nom" value="{{ old('nom', $equipe?->nom) }}">
@error('nom')
    <p>{{ $message }}</p>
@enderror

<label for="Division">Division</label>
<input type="number" id="Division" name="Division" value="{{ old('Division', $equipe?->Division) }}">
@error('Division')
    <p>{{ $message }}</p>
@enderror

<button type="submit">Enregistrer</button>
