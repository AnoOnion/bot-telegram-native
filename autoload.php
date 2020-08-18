<?php

spl_autoload_register(function ($class) {
    $file       = __DIR__."\\resource\\".$class.".php";
    $file_call  = str_replace("\\", DIRECTORY_SEPARATOR, $file);
    if (file_exists($file_call)) {
        include_once $file_call;
    } else {
        die("{$class} Not Found");
    }
});
