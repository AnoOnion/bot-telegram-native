<?php

namespace component;

use http\session        as session;
use config\request      as request;
use component\blueprint as tool;
use component\module    as module;

class bot
{
    public static function group ($config, $closure)
    {
        if (in_array('middleware', array_keys($config))) {
            if ($config['middleware']) {
                call_user_func($closure);
            }
        }
    }

    public static function get ($request, $callback)
    {
        module::route($request, $callback);
    }

    public static function fallback ()
    {
        
    }
}

