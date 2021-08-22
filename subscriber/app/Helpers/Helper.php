<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class Helper
{

    public static function apiRes($message, $data = [], $status = true, $code = 200)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ], $code);
    }
}
