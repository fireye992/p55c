<x-app-layout>
    <div class="container">
        <h1>Messages</h1>
        <ul>
            @foreach ($messages as $message)
                <li>
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->body }}
                    <br><small>{{ $message->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>  
</x-app-layout>