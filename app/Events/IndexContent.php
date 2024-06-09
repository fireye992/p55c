<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IndexContent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $type;
    public $deleted;

     /**
     * Create a new event instance.
     *
     * @param string $content
     * @param string $type
     * @param bool $deleted
     */
    public function __construct($content, $type, $deleted = false)
    {
        $this->content = $content;
        $this->type = $type;
        $this->deleted = $deleted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
    

}
