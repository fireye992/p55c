<?php

namespace App\Listeners;

use App\Events\IndexContent;
use App\Models\SearchModel;
use Illuminate\Support\Facades\Log;

class IndexContentListener
{
    /**
     * Handle the event.
     *
     * @param IndexContent $event
     * @return void
     */
    public function handle(IndexContent $event)
    {
        Log::info('IndexContentListener triggered', ['content' => $event->content, 'deleted' => $event->deleted]);

        if ($event->deleted) {
            Log::info('Deleting content', ['content' => $event->content]);
            SearchModel::where('content', $event->content)->delete();
        } else {
            $cleanContent = strip_tags($event->content);
            Log::info('Indexing content', ['cleanContent' => $cleanContent]);
            SearchModel::updateOrCreate(
                ['content' => $cleanContent],
                ['content' => $cleanContent]
            );
        }
    }
}
