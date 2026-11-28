<h1>{{ __('interface.team_create_title') }}</h1>

<form method="post" action="{{ route('equipe.store') }}" enctype="multipart/form-data">
    @csrf
    @include('Equipes._form', ['equipe' => null])
</form>

<p><a href="{{ route('equipe.index') }}">{{ __('interface.return_teams') }}</a></p>
