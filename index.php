<?php
    defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(__DIR__) . '\app');
    $DS = DIRECTORY_SEPARATOR;

    require APPLICATION_PATH . $DS . 'config' . $DS . 'config.php';
    require $paths['LIB_PATH'] . 'get_param.php';

    $page = get_param('page', 'home');
    $model = $paths['MODEL_PATH'] . $page . '.php';
    $view = $paths['VIEW_PATH'] . $page . '.phtml';
    $_404 = $paths['VIEW_PATH'] . '404.phtml';




    if (file_exists($model)) {
        require $model;
    }

    if (file_exists($view)) {
        require $view;
    } else {
        require $_404;
    }