
<h1>Créer une équipe</h1>

<form method="post" action="{{ route('equipe.store') }}">
    @include('equipes._form', ['equipe' => null])
</form>

<p><a href="{{ route('equipe.index') }}">Retour aux équipes</a></p>
