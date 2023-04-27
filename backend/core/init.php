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
define('ORIGIN_DIR', '/svetku_parvaldiba');
define('PUBLIC_DIR', '/svetku_parvaldiba/public');
define('RESOURCES_DIR', '/svetku_parvaldiba/resources');
define('POSTIMG_DIR', '/svetku_parvaldiba/resources/img/postPics');
define('PARTICIPIMG_DIR', '/svetku_parvaldiba/resources/img/participantPics');
define('COLLECTIVELOGOS_DIR', '/svetku_parvaldiba/resources/img/collectiveLogos');
define('BACKEND_DIR', '/svetku_parvaldiba/backend');
define('ADMIN_DIR', '/svetku_parvaldiba/backend/admin');

spl_autoload_register(function ($class) {
    require_once (ROOT_DIR . 'backend/classes/' . $class . '.php');
});

date_default_timezone_set('Europe/Riga');