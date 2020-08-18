<?php

namespace component;

use http\sender as send;

class blueprint {
    
    private $statusMiddleware = [
        'status'    => false,
        'condition' => false
    ];

    public function middleware ($closure)
    {
        $this->statusMiddleware = [
            'status'    => true,
            'condition' => is_callable($closure) ? call_user_func($closure) : $closure
        ];

        return $this;
    }

    public function isNot ($callback)
    {
        if ($this->statusMiddleware['status']) {
            if (!($this->statusMiddleware['condition'])) {
                $this->statusMiddleware = [
                    'status'    => false
                ];

                call_user_func_array($callback, array($this));
            }
        }

        return $this;
    }

    public function privilege ($data)
    {

    }

    public function send ($message, $option = null)
    {
        if ($this->statusMiddleware['status']) {
            if ($this->statusMiddleware['condition']) {
                send::message($message, $option);
            }
        } else {
            send::message($message, $option);
        }

        return $this;
    }

    public function update ()
    {
        
    }

    public function delete ($id)
    {
        return $this;
    }

}
