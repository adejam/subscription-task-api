<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $email;
    public $website_name;
    public $post_link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $website_name, $post_link)
    {
        $this->email = $email;
        $this->website_name = $website_name;
        $this->post_link = $post_link;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
