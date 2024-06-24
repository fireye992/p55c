<div class="card-body p-3 pt-0">
    <ul class="list-group user-list" style="max-height: 400px; overflow-y: auto;">
        @foreach ($users as $user)
            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1 user-item">
                <a href="{{ route('users.show', $user->name) }}" class="d-flex align-items-center w-100 text-decoration-none">
                    <div class="avatar avatar-sm rounded-circle me-2">
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-100">
                        @else
                            <img src="{{ asset('path/to/default/avatar.jpg') }}" alt="Default Avatar" class="w-100">
                        @endif
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm font-weight-semibold">
                            {{ $user->first_name }} {{ $user->name }}
                        </h6>
                        <p class="mb-0 text-sm text-secondary">{{ $user->about }}</p>
                    </div>
                    @if ($user->is_online)
                        <span class="p-1 bg-success rounded-circle ms-auto me-3">
                            <span class="visually-hidden">Online</span>
                        </span>
                    @else
                        <span class="p-1 bg-secondary rounded-circle ms-auto me-3">
                            <span class="visually-hidden">Offline</span>
                        </span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>



<script>
  //rafraichissement des online ECF
    document.addEventListener('DOMContentLoaded', function () {
      setInterval(() => {
          Livewire.emit('refreshUsers');
      }, 5000); // Mettre à jour toutes les 5 secondes
  });
</script>