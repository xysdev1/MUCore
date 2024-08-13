<?php
require_once __DIR__ . '/../User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    $loginSuccess = $user->login($username, $password);

    if ($loginSuccess) {
        // Redireccionar a la página de inicio
        header("Location: /cms/index.php");
        exit;
    } else {
        // Mostrar error de autenticación
        echo 'Invalid credentials';
    }
}
?>
