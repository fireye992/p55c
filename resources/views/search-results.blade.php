{{-- <x-app-layout>
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
</x-app-layout> --}}

<!-- resources/views/search/results.blade.php -->
<!-- resources/views/search/results.blade.php -->
<x-app-layout>
    <x-app.navbar/>
    <div class="container">
        <h1>Résultats de recherche</h1>
        @if($userResults->isEmpty() && $pageResults->isEmpty())
            <p>Aucun résultat trouvé.</p>
        @else
            @if(!$userResults->isEmpty())
                <h2>Utilisateurs</h2>
                <ul>
                    @foreach($userResults as $result)
                        <li class="search-result">
                            Nom: {{ $result->name }} <br>
                            Email: {{ $result->email }} <br>
                            Prénom: {{ $result->first_name }}
                        </li>
                    @endforeach
                </ul>
            @endif

            @if(!$pageResults->isEmpty())
                <h2>Pages</h2>
                <ul>
                    @foreach($pageResults as $result)
                        <li class="search-result">
                            <a href="{{ route('pages.show', $result->id) }}">{{ $result->title }}</a>
                            <p>{{ Str::limit($result->content, 150) }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
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
