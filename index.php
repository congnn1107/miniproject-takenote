<?php
//start session
session_start();
//trap
define("CORE_PATH", __DIR__ . '/core');
define('APP_PATH', __DIR__ . "/app");
define('PUBLIC_PATH', __DIR__ . "/public");

require_once CORE_PATH . '/config.php';


$controller = !empty($_GET['controller']) ? $_GET['controller'] : DEFAULT_CONTROLLER;
$action = !empty($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;
//check controller tồn tại
$controller_path = APP_PATH . "\/controller/" . $controller . ".php";

if (file_exists($controller_path)) {
    require_once($controller_path);
    if (!method_exists($controller, $action)) {
        $action = DEFAULT_ACTION;
    }
} else {
    $controller = DEFAULT_CONTROLLER;
    $action = DEFAULT_ACTION;
    $controller_path = APP_PATH . "\/controller/" . $controller . ".php";
    require_once($controller_path);
}

$object = new $controller;
$object->$action();
