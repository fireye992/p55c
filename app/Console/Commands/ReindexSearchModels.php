<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SearchModel;

class ReindexSearchModels extends Command
{
    protected $signature = 'search:reindex';
    protected $description = 'Réindexer les données dans la table search_models';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Réindexation des données...');

        $searchModels = SearchModel::all();

        foreach ($searchModels as $model) {
            $model->content = strip_tags($model->content);
            $model->save();
        }

        $this->info('Données réindexées avec succès.');
    }
}
