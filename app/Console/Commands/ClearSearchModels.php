<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearSearchModels extends Command
{
    protected $signature = 'search:clear';
    protected $description = 'Vider la table search_models';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Vidage de la table search_models...');

        DB::table('search_models')->truncate();

        $this->info('Table search_models vidée avec succès.');
    }
}
