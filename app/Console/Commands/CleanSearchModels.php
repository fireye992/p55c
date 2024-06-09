<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SearchModel;

class CleanSearchModels extends Command
{
    protected $signature = 'search:clean';
    protected $description = 'Nettoyer les données existantes dans la table search_models';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Nettoyage des données existantes...');

        $searchModels = SearchModel::all();

        foreach ($searchModels as $model) {
            $cleanContent = strip_tags($model->content);
            $model->content = $cleanContent;
            $model->save();
        }

        $this->info('Données nettoyées et mises à jour avec succès.');
    }
}
