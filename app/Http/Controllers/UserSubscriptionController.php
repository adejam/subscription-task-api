<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Website;
use Illuminate\Http\Response;

class UserSubscriptionController extends Controller
{
    /**
     * This controller method subscribes a user to a website.
     *
     * @param \Illuminate\Http\Request $request // Request coming from endpoint
     * @param string                      $website_id      // This is the ID of the website to subscribed to
     *
     * @return Illuminate\Http\Response // response returned which include the status code,
     * message
     */
    public function subscribe(Request $request, int $website_id): Response
    {
        $website = Website::where('id', '=', $website_id)->first();
        if (!$website) {
            abort(404);
        }

        $request->validate(
            [
                'user_email' => 'required|email|max:255',
            ]
        );
        
        $userSub = UserSubscription::where('user_email', '=', $request->user_email)->where('website_id', '=', $website_id)->first();
        if ($userSub) {
            return response(
                [
                    'message' => 'User already subscribed to this website',
                ],
                422
            );
        }
        $sub = new UserSubscription;
        $sub->user_email = $request->user_email;
        $sub->website_id = $website_id;
        $sub->save();

        return response(
            [
                'message' => 'User successfully subscribed',
            ],
            201
        );
    }
}
