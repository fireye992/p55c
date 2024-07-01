<?php

namespace App\Livewire\Chat;

use App\Events\MessageSent;
use App\Events\MessageRead;
use App\Models\Conversations;
use App\Models\Messaje;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiver;
    public $messages;
    public $paginateVar = 10;
    public $height;
    public $receiverInstance;

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            "echo-private:chat.{$auth_id},MessageSent" => 'broadcastedMessageReceived',
            "echo-private:chat.{$auth_id},MessageRead" => 'broadcastedMessageRead',
            'loadConversation', 'pushMessage', 'loadmore', 'updateHeight', 'broadcastMessageRead', 'resetComponent'
        ];
    }

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    public function broadcastedMessageRead($event)
    {
        if ($this->selectedConversation) {
            if ((int)$this->selectedConversation->id === (int)$event['conversation_id']) {
                $this->dispatchBrowserEvent('markMessageAsRead');
            }
        }
    }

    public function broadcastedMessageReceived($event)
    {
        $this->dispatch('chat.chat-list', 'refresh');

        $broadcastedMessage = Messaje::find($event['messaje']);

        if ($this->selectedConversation) {
            if ((int)$this->selectedConversation->id === (int)$event['conversation_id']) {
                $broadcastedMessage->read = 1;
                $broadcastedMessage->save();
                $this->pushMessage($broadcastedMessage->id);
                $this->dispatch('broadcastMessageRead');
            }
        }
    }

    public function broadcastMessageRead()
    {
        $this->dispatch(new MessageRead($this->selectedConversation->id, $this->receiverInstance->id));
    }

    public function pushMessage($messageId)
    {
        $newMessage = Messaje::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    public function loadmore()
    {
        $this->paginateVar += 10;
        $this->messages_count = Messaje::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Messaje::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)->get();

        $this->dispatchBrowserEvent('updatedHeight', $this->height);
    }

    public function updateHeight($height)
    {
        $this->height = $height;
    }

    public function loadConversation(Conversations $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

        $this->messages_count = Messaje::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Messaje::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)->get();

        $this->dispatchBrowserEvent('chatSelected');

        Messaje::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', auth()->user()->id)
            ->update(['read' => 1]);

        $this->dispatch('broadcastMessageRead');
    }

    public function render()
    {
        return view('livewire.chat.chatbox')->layout('layouts.app');
    }
}
