<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateTweetRequest $request)
    {
        $content = $request->getTweet();

        $tweet = new Tweet();
        $tweet->content = $content;
        $tweet->save();

        return response()->json($tweet);
    }
}
