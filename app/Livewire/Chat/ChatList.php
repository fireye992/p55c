<?php

namespace App\Livewire\Chat;

use App\Models\Conversations;
use App\Models\User;
use Livewire\Component;

class ChatList extends Component
{
    public $auth_id;
    public $conversations;
    public $receiverInstance;
    public $name;
    public $selectedConversation;

    protected $listeners = ['chatUserSelected', 'refresh' => '$refresh', 'resetComponent'];

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    public function chatUserSelected(Conversations $conversation, $receiverId)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = User::find($receiverId);

        // Utiliser dispatch pour émettre des événements aux composants spécifiques
        $this->dispatch('chat.chatbox', 'loadConversation', $this->selectedConversation, $this->receiverInstance);
        $this->dispatch('chat.send-message', 'updateSendMessage', $this->selectedConversation, $this->receiverInstance);
    }

    public function getChatUserInstance(Conversations $conversation, $request)
    {
        $this->auth_id = auth()->id();

        if ($conversation->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere('id', $conversation->receiver_id);
        } else {
            $this->receiverInstance = User::firstWhere('id', $conversation->sender_id);
        }

        if (isset($request)) {
            return $this->receiverInstance->$request;
        }
    }

    public function mount()
    {
        $this->auth_id = auth()->id();
        $this->conversations = Conversations::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)
            ->orderBy('last_time_message', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
