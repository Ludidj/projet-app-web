
<h1>Modifier une équipe</h1>

<form method="post" action="{{ route('equipes.update', $equipe) }}" enctype="multipart/form-data">
    @method('PATCH')
    @include('equipes
    ._form')
</form>

<label for="image">Image</label>
<input id="image" name="image" type="file"
       accept="image/jpeg,image/png,image/webp">
@error('image') <p>{{ $message }}</p> @enderror



<p><a href="{{ route('equipe.show', $equipe) }}">Retour à l'équipe</a></p>
