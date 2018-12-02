<?php
namespace App\Helpers;

class Response
{
    public static function to404()
    {
        $request = app("request");
        $link = $request->header("referer");
        return view("admin.404", ["link" => $link]);
    }

    public static function json($data = [])
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}