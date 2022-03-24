<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Website;
use App\Services\PostService;
use App\Http\Resources\PostResource;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private $_postService;

    public function __construct(PostService $postService)
    {
        $this->_postService = $postService;
    }

    /**
     * This controller method craete a new post.
     *
     * @param \Illuminate\Http\Request $request // Request coming from endpoint
     * @param string                      $website_id      // This is the ID of the website where the post was created
     *
     * @return Illuminate\Http\Response // response returned which include the status code,
     * message and the API resource of the post created
     */
    public function create(Request $request, int $website_id): Response
    {
        $website = Website::where('id', '=', $website_id)->first();
        if (!$website) {
            abort(404);
        }

        $request->validate(
            [
                'title' => 'required|string|max:255|unique:posts',
                'description' => 'required|string|max:1000',
            ]
        );

        $post = $this->_postService->createPost($request, $website);

        return response(
            [
                'message' => 'Post successfully created',
                'Post' => new PostResource(Post::where('post_id', '=', $post->post_id)->firstOrFail()),
            ],
            201
        );
    }
}
