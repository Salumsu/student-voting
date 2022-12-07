<?php
    defined('APPLICATION_PATH') || define('APPLICATION_PATH', substr(realpath(__DIR__), 0, 34));
    $DS = DIRECTORY_SEPARATOR;

    $paths = [
        'LIB_PATH' => APPLICATION_PATH . $DS . 'lib' . $DS,
        'VIEW_PATH' => APPLICATION_PATH . $DS . 'views' . $DS,
        'MODEL_PATH' => APPLICATION_PATH . $DS . 'models' . $DS,
        'CONTROLLER_PATH' => substr(APPLICATION_PATH, 15) . $DS . 'controllers' . $DS,
        'INDEX_PATH' => substr(APPLICATION_PATH, 15) . $DS,
        'DATABASE_MODEL_PATH' => APPLICATION_PATH . $DS . 'models' . $DS . 'database-models' . $DS,
        'CSS_PATH' => substr(APPLICATION_PATH, 15) . $DS . 'utils' . $DS . 'css' . $DS,
        'JS_PATH' => substr(APPLICATION_PATH, 15) . $DS . 'utils' . $DS . 'js' . $DS,
        
    ];

    $database = [
        'HOST' => 'localhost',
        'USER' => 'root',
        'PASSWORD' => '',
        'DATABASE_NAME' => 'vote',
    ];


    $conn = mysqli_connect($database['HOST'], $database['USER'], $database['PASSWORD'], $database['DATABASE_NAME']);

    if (!$conn) {
        die('Cannot connect to the database');
    }