<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SearchModel;
use App\Models\Page;
use App\Models\Article;

class IndexSearchModels extends Command
{
    protected $signature = 'search:index';
    protected $description = 'Indexer les contenus visibles par l\'utilisateur';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Indexation des contenus visibles par l\'utilisateur...');

        // Extraction des contenus depuis les modèles Page et Article
        $pages = Page::all();
        $articles = Article::all();

        // Ajout de journaux pour le diagnostic
        $this->info('Pages trouvées: ' . $pages->count());
        $this->info('Articles trouvés: ' . $articles->count());

        // Indexation des pages
        foreach ($pages as $page) {
            $cleanContent = strip_tags($page->content);
            $this->info('Indexation du contenu de la page: ' . $cleanContent);
            SearchModel::create(['content' => $cleanContent]);
        }

        // Indexation des articles
        foreach ($articles as $article) {
            $cleanContent = strip_tags($article->content);
            $this->info('Indexation du contenu de l\'article: ' . $cleanContent);
            SearchModel::create(['content' => $cleanContent]);
        }

        $this->info('Contenus indexés avec succès.');
    }
}
