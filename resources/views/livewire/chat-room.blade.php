{{-- resources/views/livewire/chat-room.blade.php --}}

<main class="main-content position-relative max-height-vh-100 h-100">
    <x-app.navbar/>
    <div class="container my-5" wire:poll.keep-alive.5s="loadMessages">
        <h4>Chat with {{ $recipientName }}</h4>
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

</main>


