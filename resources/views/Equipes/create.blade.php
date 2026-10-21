
<h1>Créer une équipe</h1>

<form method="post" action="{{ route('equipes.store') }}">
    @include('equipes._form', ['equipe' => null])
</form>

<p><a href="{{ route('equipes.index') }}">Retour aux équipes</a></p>
