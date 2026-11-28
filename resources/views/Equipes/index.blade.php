@extends('layouts.app')

@section('title', __('interface.teams'))

@section('content')
    <h1>{{ __('interface.teams') }}</h1>

    @if (auth()->check() && auth()->user()->role === \App\Models\User::ROLE_MANAGER)
    <a href="{{ route('equipe.create') }}">{{ __('interface.team_create_title') }}</a>
    

@endif

@if (auth()->check() && auth()->user()->role === \App\Models\User::ROLE_ADMIN)
@endif
    <a href="{{ route('sport.create') }}">{{ __('interface.add_sport') }}</a>

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
        <p>{{ __('interface.teams_empty') }}</p>
    @endforelse

    {{ $equipes->links('pagination.simple') }}
@endsection

@push('scripts')
    <script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush
