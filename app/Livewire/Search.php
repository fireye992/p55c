<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Page;

class Search extends Component
{
    public $query = '';
    public $userResults = [];
    public $pageResults = [];

    public function updatedQuery()
    {
        $this->search();
    }

    public function search()
    {
        if (strlen($this->query) > 2) {
            $this->userResults = User::where('name', 'LIKE', "%{$this->query}%")
                                    ->orWhere('email', 'LIKE', "%{$this->query}%")
                                    ->orWhere('first_name', 'LIKE', "%{$this->query}%")
                                    ->get();

            $this->pageResults = Page::where('title', 'LIKE', "%{$this->query}%")
                                    ->orWhere('content', 'LIKE', "%{$this->query}%")
                                    ->get();
        } else {
            $this->userResults = [];
            $this->pageResults = [];
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}