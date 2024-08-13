<?php
require_once 'config/config.php';
require_once 'system/functions/global_functions.php';

// Obtener configuración de base_url
$config = include 'config/config.php';
$baseUrl = rtrim($config['base_url'], '/'); // Eliminar barra final si existe

// Obtener URI solicitada
$requestUri = $_SERVER['REQUEST_URI'];

// Normalizar la URI para eliminar el prefijo de la base_url
$baseUri = str_replace($baseUrl, '', $requestUri);

// Si la baseUri está vacía, asignar '/'
if (empty($baseUri)) {
    $baseUri = '/';
}

// Limpiar el valor de baseUri (en caso de que tenga barras adicionales al final)
$baseUri = rtrim($baseUri, '/');

// Depuración (elimina esto en producción)
// var_dump($requestUri);  // URI completa
// var_dump($baseUri);     // URI después de eliminar base_url

switch ($baseUri) {
    case '':
    case '/':
        include 'home.php'; // Actualiza la ruta a la vista en el root
        break;
    case 'login':
        include 'login.php'; // Actualiza la ruta a la vista en el root
        break;
    // Agrega más casos para otras rutas aquí
    default:
        http_response_code(404);
        include '404.php'; // Actualiza la ruta a la vista en el root
        break;
}
?>
