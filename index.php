<?php
require_once 'config/config.php';
require_once 'system/functions/global_functions.php';

// Rutas
$requestUri = $_SERVER['REQUEST_URI'];
$baseUri = parse_url($requestUri, PHP_URL_PATH);

switch ($baseUri) {
    case '/':
        include 'views/home.php';
        break;
    case '/login':
        include 'module/User/actions/login_action.php';
        include 'views/login.php';
        break;
    default:
        http_response_code(404);
        include 'views/404.php';
        break;
}
?>
