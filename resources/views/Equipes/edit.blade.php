
<h1>Modifier une équipe</h1>

<form method="post" action="{{ route('equipe.update', $equipe) }}">
    @method('PATCH')
    @include('equipes._form')
</form>

<p><a href="{{ route('equipe.show', $equipe) }}">Retour à l'équipe</a></p>
