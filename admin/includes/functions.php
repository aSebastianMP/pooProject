<?php

    function classAutoloader($class){
        $class = strtolower($class);
        $path = "includes/{$class}.php";
        if(file_exists($path)){
            require_once($path);
        } else {
            die("This file name {$class}.php was not found");
        }
    }

    function redirect($location){
        header("Location: {$location}");
    }

    spl_autoload_register("classAutoloader");

?>