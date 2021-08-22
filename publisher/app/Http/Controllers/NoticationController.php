<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Services\AllServices\Notify;
use Illuminate\Http\Request;

class NoticationController extends Controller
{
    public function subscribe(Request $request, $topic)
    {
        if (!$request->url) {
            return response()->json(["message" => "url is required in request body"], 422);
        }

        try {
            Notify::susbcribe($topic, $request->url);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json([
            "url" => $request->url,
            "topic" => $topic,
            "message" => "url susbcribed successfully"
        ], 200);
    }

    public function publish(Request $request, $topic)
    {

        if (!$request->message) {
            return response()->json(["message" => "message is required in request body"], 422);
        }


        try {
            Notify::startPublish($topic, $request->message);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }

        return response()->json([
            "message" => "publish successful",
        ], 200);
    }
}
