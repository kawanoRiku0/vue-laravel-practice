<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePostRequest $request)
    {
        $tweetId = $request->route('tweet_id');
        $tweet = Tweet::find($tweetId);

        if (is_null($tweet)) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }

        $tweet->content = $request->getTweet();
        $tweet->save();
        return response()->json($tweet, 200);
    }
}
