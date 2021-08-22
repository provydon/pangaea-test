<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

class NoticationController extends Controller
{
    public function callback1(Request $request)
    {
        echo $request->data;
        return Helper::apiRes("Message Received", ["message" => $request->data]);
    }

    public function callback2(Request $request)
    {
        echo $request->data;
        return Helper::apiRes("Message Received", ["message" => $request->data]);
    }
}
