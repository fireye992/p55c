<?php

namespace App\Livewire\Chat;

use App\Models\Conversations;
use App\Models\Messaje;
use App\Models\User;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public $message = 'hello how are you';

    public function checkconversation($receiverId)
    {
        $authId = auth()->user()->id;

        $checkedConversation = Conversations::where(function ($query) use ($authId, $receiverId) {
            $query->where('receiver_id', $authId)
                  ->where('sender_id', $receiverId);
        })->orWhere(function ($query) use ($authId, $receiverId) {
            $query->where('receiver_id', $receiverId)
                  ->where('sender_id', $authId);
        })->get();

        if ($checkedConversation->isEmpty()) {
            $createdConversation = Conversations::create([
                'receiver_id' => $receiverId,
                'sender_id' => $authId
            ]);

            $createdMessage = Messaje::create([
                'conversation_id' => $createdConversation->id,
                'sender_id' => $authId,
                'receiver_id' => $receiverId,
                'body' => $this->message
            ]);

            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();
        } else {
            dd('conversation exists');
        }
    }

    public function render()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)->get();

        return view('livewire.chat.create-chat');
    }
}
