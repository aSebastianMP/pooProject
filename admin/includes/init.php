<?php

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'gallery');

    defined('INCLDUES_PATH') ? null : define('INCLDUES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

    require_once("functions.php");
    include("new_config.php");
    include("database.php");
    require_once("db_Object.php");
    include("user.php");
    require_once("photo.php");
    include("session.php");

?>