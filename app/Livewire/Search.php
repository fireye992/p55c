<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SearchModel;

class Search extends Component
{
    use WithPagination;

    public $query = '';
    public $results;

    protected $updatesQueryString = ['query'];

    public function mount()
    {
        $this->results = collect(); // Initialisez la propriété $results comme une collection vide
    }

    public function updatedQuery()
    {
        $this->resetPage();
        $this->search();
    }

    public function search()
    {
    

        if (!empty($this->query)) {
            $this->results = SearchModel::where('content', 'like', '%' . $this->query . '%')
                                        ->orWhere('html_content', 'like', '%' . $this->query . '%')
                                        ->paginate(5);


        } else {
            $this->results = collect(); // Utiliser une collection vide par défaut

        }
    }

    public function render()
    {
        return view('livewire.search', [
            'results' => $this->results
        ]);
    }
}
