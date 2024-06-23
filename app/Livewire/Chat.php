<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Chat extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all(); // Récupère tous les utilisateurs
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
