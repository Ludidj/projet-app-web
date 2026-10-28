@extends('layouts.app')

@section('title', 'Équipes')

@section('content')
    <h1>Équipes</h1>

    <a href="{{ route('equipe.create') }}">Ajouter une équipe</a>

    <label for="search">{{ __('interface.search') }}</label>
    <input id="search" type="search" autocomplete="off"
           data-search-url="{{ route('recherche.equipes') }}"
           data-searching="{{ __('interface.searching') }}"
           data-empty="{{ __('interface.no_results') }}"
           data-count="{{ __('interface.results') }}"
           data-error="{{ __('interface.search_error') }}">

    <p id="search-status" role="status" aria-live="polite"></p>
    <ul id="search-results"></ul>

    @forelse ($equipes as $equipe)
        <article>
            <h2>
                <a href="{{ route('equipe.show', $equipe) }}">
                    {{ $equipe->nom }}
                </a>
            </h2>
        </article>
    @empty
        <p>Aucune équipe enregistrée.</p>
    @endforelse

    {{ $equipes->links() }}
@endsection

@push('scripts')
    <script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush