<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $website_name;
    public $post_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($website_name, $post_link)
    {
        $this->website_name = $website_name;
        $this->post_link = $post_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.post_created')->with('website_name', $this->website_name)->with('post_link', $this->post_link);
    }
}
