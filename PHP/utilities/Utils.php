<?php


class Utils
{
    static function redirect($url, $status=302){
        http_response_code($status);
        header("Location: $url");
        die();
    }
}
