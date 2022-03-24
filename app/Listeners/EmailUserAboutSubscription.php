<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PodcastProcessed;
use App\Mail\PostCreateMail;
use App\Events\PostCreated;
use Mail;

class EmailUserAboutSubscription implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to($event->email)->send(new PostCreateMail($event->website_name, $event->post_link));
    }
}
