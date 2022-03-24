<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use DB;
use App\Models\UserSubscription;
use App\Models\SentPost;
use App\Events\PostCreated;

class PostService
{
    /**
     * This method It takes is the validated data from controller and returns the model instance
     * of the store created
     *
     * @param array $data // array of validated data to be added
     *
     * @return Illuminate\Database\Eloquent\Model // model instance of the store added.
     */
    public function createPost(object $data, object $website): Model
    {
        $postId = utf8_encode(Uuid::generate());
        $post = new Post;
        $post->post_id = $postId;
        $post->website_id = $website->id;
        $post->title = $data->title;
        $post->description = $data->description;
        $post->save();

        $userSubs = UserSubscription::where('website_id', '=', $website->id)->get();
        
        foreach ($userSubs as $userSub) {
            $post_link = "https://".$website->website_name."/post=".$post->post_id;
            $userAlreadySentPost = SentPost::where('email', '=', $userSub->user_email)->where('post_id', '=', $post->id)->first();
            if (!$userAlreadySentPost) {
                $sentPost = new SentPost;
                $sentPost->website_id = $website->id;
                $sentPost->post_id = $post->id;
                $sentPost->email = $userSub->user_email;
                $sentPost->save();
                event(new PostCreated($userSub->user_email, $website->website_name, $post_link));
            }
        }
        return $post;
    }
}
