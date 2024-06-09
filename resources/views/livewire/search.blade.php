{{-- <div class="container mt-3">
    <div class="input-group mb-3">
        <input type="text" wire:model.debounce.300ms="query" class="form-control" placeholder="Search for...">
    </div>

    @if($results->isNotEmpty())
        <h2>Search Results for "{{ $query }}"</h2>
        <div class="list-group">
            @foreach ($results as $result)
                <a href="{{ route('search.result', ['id' => $result->id]) }}" class="list-group-item list-group-item-action">
                    {!! highlight(str_limit($result->content, 100), $query) !!}
                </a>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $results->links() }} <!-- Pagination links -->
        </div>
    @else
        @if(!empty($query))
            <p>No results found.</p>
        @endif
    @endif
</div> --}}

{{-- VErsion Claude --}}

{{-- @foreach($results as $result)
    <h1>Recherche</h1>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Rechercher...">
        <button type="submit">Rechercher</button>
    </form>
@endforeach --}}

{{--  autre version gpt --}}

<x-app-layout>
    <h1>Recherche</h1>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Rechercher...">
        <button type="submit">Rechercher</button>
    </form>
</x-app-layout>