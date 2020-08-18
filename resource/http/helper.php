<?php

namespace http;

class helper
{
    public static function get ($url, $callback = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result = curl_exec($ch);
        curl_close($ch);

        if (is_callable($callback)) {
            call_user_func_array($callback, array($result));
        }

        return $result;
    }


    public static function media ($url)
    {
        $ch = curl_init ($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);

        $raw = curl_exec($ch);

        curl_close ($ch);

        return $raw;
    }

    public static function curl ($url, $postfields)
    {
        if (!$curld = curl_init()) {
            exit;
        }

        curl_setopt($curld, CURLOPT_POST, true);
        curl_setopt($curld, CURLOPT_HTTPHEADER, array(
            "Content-Type: multipart/form-data"
        ));
        curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($curld, CURLOPT_URL, $url);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curld, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($curld);

        curl_close($curld);
    }
}
