<?php

namespace component;

use config\request;

class module {

    public static function session ($session, $callback = null)
    {
        if (request::session($session)) {
            call_user_func($callback);
        }
    }

    public static function route ($request, $callback)
    {
        $response = is_array($request) ? $request['req'] : $request;
        $request  = in_array(request::message(), explode('|', $response));
        $session  = is_array($request) ? request::session($request['session']) : true;
        
        $middleware = isset($request['middleware']) ? is_callable($request['middleware']) ? call_user_func($request['middleware']) : $request['middleware'] : true;

        if ($request && $session && $middleware) {
            $option = [
                new \component\blueprint,
                new \http\session
            ];

            if (is_callable($callback)) {
                call_user_func_array($callback, $option);
            } else {
                call_user_func_array($callback['callback'], $option);
            }
        }
    }
    
}
