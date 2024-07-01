<div x-data="{ showDropdown: false }" @click.away="showDropdown = false">
    <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
            </svg>
        </span>
        <input type="text" wire:model.live="query" placeholder="Search..." class="form-control border-start-0"
            @focus="showDropdown = true" @keydown.enter="showDropdown = true; $wire.updateQuery()" />
    </div>

    @if (strlen($query) > 2)
        <div class="dropdown-menu show" x-show="showDropdown" style="display: block;">
            <div class="dropdown-item-cs">
                <h6 class="dropdown-header">Utilisateurs</h6>
                <ul class="list-unstyled">
                    @foreach ($userResults as $user)
                        <li class="dropdown-item d-flex align-items-center">
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                            <div>
                                <a href="{{ route('users.show', $user->slug) }}" class="text-decoration-none">
                                    <strong>Nom:</strong> {{ $user->name }}<br>
                                    <strong>Prénom:</strong> {{ $user->first_name }}
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>                
            </div>
            <div class="dropdown-item-cs">
                <h6 class="dropdown-header">Pages</h6>
                <ul class="list-unstyled">
                    @foreach ($pageResults as $page)
                        <li class="dropdown-item">
                            <a href="{{ url($page['path']) }}" class="text-decoration-none">
                                {{ $page['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>