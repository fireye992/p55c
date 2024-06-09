<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SearchModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class IndexBladeContent extends Command
{
    protected $signature = 'search:index-blade';
    protected $description = 'Indexer le contenu des vues Blade';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Indexation des contenus des vues Blade...');

        // Parcourir les fichiers Blade
        $viewsPath = resource_path('views');
        $files = File::allFiles($viewsPath);

        foreach ($files as $file) {
            if ($file->getExtension() == 'blade.php') {
                $content = File::get($file->getRealPath());
                $cleanContent = $this->extractVisibleText($content);
                $this->info('Indexation du contenu de la vue: ' . $file->getRelativePathname());
                SearchModel::create(['content' => $cleanContent]);
            }
        }

        $this->info('Contenus des vues Blade indexés avec succès.');
    }

    /**
     * Extraire le texte visible du contenu Blade
     *
     * @param string $content
     * @return string
     */
    private function extractVisibleText($content)
    {
        // Supprimer les directives Blade
        $content = preg_replace('/\{\{.*?\}\}/s', '', $content);
        $content = preg_replace('/\@\w+.*?\n/s', '', $content);

        // Supprimer les balises HTML
        return strip_tags($content);
    }
}
