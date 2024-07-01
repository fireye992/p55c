{{-- resources/views/livewire/chat-room.blade.php --}}

<main class="main-content position-relative max-height-vh-100 h-100">
    <x-app.navbar/>
    <div class="container my-5" wire:poll.keep-alive.5s="loadMessages">
        <h4>Tchat avec {{ $recipientFirstName }}</h4>
        <div id="chat-container" class="chat-container" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; max-height: 500px; overflow-y: scroll;">
            @foreach($messages as $message)
                <div id="message-{{ $message['id'] }}" class="message {{ $message['from_user_id'] == Auth::id() ? 'my-message' : 'other-message' }} {{ $message['id'] == $newMessageId ? 'new-message' : '' }}" style="margin-bottom: 10px;">
                    <strong>{{ $message['from_user_id'] == Auth::id() ? 'You' : $recipientName }}:</strong>
                    <p>{{ $message['body'] }}</p>
                </div>
            @endforeach
        </div>
        <form wire:submit.prevent="sendMessage" class="mt-3">
            <div class="form-group">
                <input type="text" wire:model="messageText" placeholder="Type your message here" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Send</button>
        </form>
    </div>

    {{-- <div class="card-body p-3 pt-0">
        <ul class="list-group user-list" style="max-height: 400px; overflow-y: auto;">
            @foreach ($users as $user)
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-1 user-item">
                    <a href="{{ route('conversation.start', $user->slug) }}" class="d-flex align-items-center w-100 text-decoration-none">
                        <div class="avatar avatar-sm rounded-circle me-2">
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->slug }}" class="w-100">
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
    </div> --}}
    
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          setInterval(() => {
              Livewire.dispatch('refreshUsers');
          }, 5000);
      });
    </script>
    