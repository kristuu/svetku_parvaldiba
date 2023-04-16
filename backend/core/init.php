<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'svetku_parvaldiba'
    ),
    'session' => array(
        'session_name' => 'user'
    )
);

define('ROOT_DIR', dirname(__FILE__, 3) . '/');
define('PUBLIC_DIR', '/svetku_parvaldiba/public');
define('IMG_DIR', '/svetku_parvaldiba/resources/img');

spl_autoload_register(function ($class) {
    require_once (ROOT_DIR . 'backend/classes/' . $class . '.php');
});