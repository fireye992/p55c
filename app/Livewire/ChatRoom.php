<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatRoom extends Component
{
    public $messages;
    public $messageText;
    public $recipientName;
    public $recipientId;
    public $newMessageId;

    public function mount($recipientName)
    {
        $this->recipientName = $recipientName;
        $recipient = User::where('name', $this->recipientName)->firstOrFail();
        $this->recipientId = $recipient->id;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function($query) {
            $query->where('from_user_id', Auth::id())
                  ->where('to_user_id', $this->recipientId);
        })->orWhere(function($query) {
            $query->where('from_user_id', $this->recipientId)
                  ->where('to_user_id', Auth::id());
        })->where('created_at', '>=', Carbon::now()->subDay()) // Limiter aux dernières 24 heures
          ->latest()
          ->take(50)
          ->get()
          ->reverse()
          ->toArray();
          
        // Déclenche l'événement JavaScript pour faire défiler

    }

    public function sendMessage()
    {
        $this->validate([
            'messageText' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->recipientId,
            'body' => $this->messageText,
        ]);

        $this->messageText = '';
        $this->newMessageId = $message->id;
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat-room', [
            'messages' => $this->messages,
        ])->layout('layouts.app'); // Spécifiez ici votre mise en page
    }
}
