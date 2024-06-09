<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SearchModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class IndexBladeFiles extends Command
{
    protected $signature = 'index:blade-files';
    protected $description = 'Index the content of Blade files into the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $bladeFiles = File::allFiles(resource_path('views'));

        foreach ($bladeFiles as $file) {
            try {
                $content = File::get($file->getRealPath());
                // Strip out Blade directives and PHP code
                $content = preg_replace('/\{\{.*?\}\}|\{!!.*?!!\}|\@.*?(\r\n|\r|\n)/s', '', $content);

                // Validate and truncate content length
                $maxLength = 65535; // Maximum length for a TEXT column in MySQL
                if (strlen($content) > $maxLength) {
                    $content = substr($content, 0, $maxLength);
                    Log::warning('Truncated content for file: ' . $file->getRelativePathname());
                }

                if (strlen($content) > 0) {
                    SearchModel::create([
                        'content' => $content,
                        'html_content' => null, // or any other way to store it
                    ]);

                    $this->info('Indexed: ' . $file->getRelativePathname());
                } else {
                    $this->warn('Skipped empty content: ' . $file->getRelativePathname());
                }
            } catch (\Exception $e) {
                Log::error('Failed to index file: ' . $file->getRelativePathname() . '. Error: ' . $e->getMessage());
                $this->error('Failed to index: ' . $file->getRelativePathname() . '. Error: ' . $e->getMessage());
            }
        }

        $this->info('All Blade files have been indexed.');
    }
}
