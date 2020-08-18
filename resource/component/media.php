<?php

namespace component;

use config\request;

class media
{

    public static $data = array();

    public static function get ()
    {
        return self::$data;
    }

    public static function get_reset ()
    {
        self::$data = array();
    }

    public static function caption ($text)
    {
        self::$data = compact('text');

        return new static;
    }

    public static function image ($url, $type = null, $name = null)
    {
        self::get_reset();
        $data_raw = request::curl_media($url);

        if(file_exists($name)){
            unlink($name);
        }

        $fp = fopen($name, 'x');
        fwrite($fp, $data_raw);
        fclose($fp);

        self::$data = compact('name');

        return new static;
    }

}
