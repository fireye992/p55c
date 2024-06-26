<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class UsersList extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all(); // Récupère tous les utilisateurs
    }

    public function render()
    {
        $this->users = User::all()->map(function ($user) {
            $user->is_online = $this->isOnline($user);
            return $user;
        })->sortByDesc('is_online');

        return view('livewire.users-list', [
            'users' => $this->users
        ]);
    }

    private function isOnline($user)
    {
        return $user->last_activity && Carbon::parse($user->last_activity)->gt(Carbon::now()->subMinutes(5));
    }

    protected $listeners = ['refreshUsers'];

    public function refreshUsers()
    {
        // Rafraîchit les utilisateurs
        $this->render();
    }
}
