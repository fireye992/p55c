<x-app-layout>
    <x-app.navbar/>
    <div class="container">
        <h1>Résultats de recherche</h1>
        @if($results->isEmpty())
            <p>Aucun résultat trouvé.</p>
        @else
            <ul>
                @foreach($results as $result)
                    <li class="search-result">{{ $result->content }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <style>
        .search-result {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</x-app-layout>