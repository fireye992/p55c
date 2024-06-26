<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class Search extends Component
{
    public $query = '';
    public $userResults = [];
    public $pageResults = [];

    // Déclaration de la propriété $includePages
    protected $includePages = [
        'dashboard',
        'users/{name}',
        'wallet',
        'table',
        'pages/about',
        'pages/contact',
        'medias',
        'profile',
        'chatRoom',
        'users-list',
        // Ajoutez d'autres pages à inclure ici
    ];

    public function mount()
    {
        if (strlen($this->query) > 2) {
            $this->updateQuery();
        }
    }

    public function updatedQuery()
    {
        $this->updateQuery();
    }

    public function updateQuery()
    {
        $words = '%' . $this->query . '%';

        if (strlen($this->query) > 2) {
            $this->userResults = User::where('name', 'LIKE', $words)
                ->orWhere('first_name', 'LIKE', $words)
                ->orWhere('email', 'LIKE', $words)
                ->get();

            $this->pageResults = $this->searchBladeFiles($this->query);
        } else {
            $this->userResults = [];
            $this->pageResults = [];
        }
    }

    private function searchBladeFiles($query)
    {
        $results = [];
        $bladeFiles = File::allFiles(resource_path('views'));

        foreach ($bladeFiles as $file) {
            $relativePath = str_replace(resource_path('views') . '/', '', $file->getRealPath());
            $relativePath = str_replace('.blade.php', '', $relativePath);

            if (!$this->shouldIncludePage($relativePath)) {
                continue;
            }

            $content = File::get($file->getRealPath());
            if (stripos($content, $query) !== false) {
                $results[] = [
                    'title' => basename($relativePath), // Supprimer le chemin complet et ne garder que le nom de fichier sans extension
                    'path' => $relativePath
                ];
            }
        }

        return $results;
    }

    private function shouldIncludePage($path)
    {
        return in_array($path, $this->includePages);
    }

    public function render()
    {
        return view('livewire.search');
    }
}