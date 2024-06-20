<!-- resources/views/livewire/search.blade.php -->
<div class="search-component">
    <div class="input-group">
        <input type="text" wire:model.debounce.500ms="query" placeholder="Search..." class="form-control" />
    </div>

    @if(strlen($query) > 2)
        <div class="results">
            <h2>Utilisateurs</h2>
            <ul>
                @foreach($userResults as $user)
                    <li>
                        <a href="{{ route('users.show', $user->id) }}">
                            Nom: {{ $user->name }}
                        </a>
                        <br>Email: {{ $user->email }}
                        <br>Prénom: {{ $user->first_name }}
                    </li>
                @endforeach
            </ul>

            <h2>Pages</h2>
            <ul>
                @foreach($pageResults as $page)
                    <li>
                        <a href="{{ route('pages.show', $page->id) }}">
                            {{ $page->title }}
                        </a>
                        <p>{{ Str::limit($page->content, 150) }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
