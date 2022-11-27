<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tweetId = $request->route('tweet_id');
        $tweet = Tweet::find($tweetId);

        if (is_null($tweet)) {
            return response()->json(['message' => 'Tweet not found'], 404);
        }

        $tweet->delete();

        return response()->json([], 200);
    }
}
