<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PublisherController extends Controller
{
    public function index(PublisherRequest $request, $category){
        $body = $request->validated();
        Redis::publish($category, json_encode([
            "news_title" => $body['title'],
            "excerpt" => $body['excerpt'],
            "description" => $body['description'],
        ]));

        return response()->json(
            [
                "message" => "$category published successfully!",
            ]
        );
    }
}
