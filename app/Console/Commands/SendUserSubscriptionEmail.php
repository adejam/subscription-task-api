<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\PostCreated;

class SendUserSubscriptionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:new-created-post-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to user after a post has been created through artisan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_email = $this->ask('Enter the user email?');
        $website_name = $this->ask('Enter the website name?');
        $post_link = $this->ask('Enter the post link?');
        event(new PostCreated($user_email, $website_name, $post_link));
    }
}
