<?php
session_start();

define('ROOT_DIR', dirname(__FILE__, 3) . '/');

spl_autoload_register(function ($class) {
    require_once ROOT_DIR . 'backend/classes/' . $class . '.php';
});