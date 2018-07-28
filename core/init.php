<?php

define('HOST','127.0.0.1');
define('USERNAME', 'root');
define('PASSWORD','');
define('DB','job');

define('PATH',dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function($class){
    if(file_exists(PATH.DS.'helper'.DS. $class .'.php')){
        require_once PATH.DS.'helper'.DS. $class .'.php';
    }elseif(file_exists(require_once PATH.DS.'models'.DS. $class .'.php')){
        require_once PATH.DS.'models'.DS. $class .'.php';
    }
});

require_once PATH.DS.'functions'.DS.'functions.php';
require_once 'constant.php';
session_start();
?>
