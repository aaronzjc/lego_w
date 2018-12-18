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

    public static function jsonSuccess($msg, $data = [])
    {
        $re = [
            "success" => true,
            "msg" => $msg?:"成功",
            "data" => $data
        ];
        return json_encode($re, JSON_UNESCAPED_UNICODE);
    }

    public static function jsonFail($msg, $data = [])
    {
        $re = [
            "success" => false,
            "msg" => $msg?:"失败",
            "data" => $data
        ];
        return json_encode($re, JSON_UNESCAPED_UNICODE);
    }
}