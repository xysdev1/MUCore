<?php
// Asegúrate de que el archivo de la clase Database esté incluido
require_once 'system/database/Database.php';

// Crear una instancia de la clase Database
$db = new Database();

// Obtener la conexión PDO
$pdo = $db->getConnection();

// Probar la conexión con una consulta simple
try {
    $stmt = $pdo->query("SELECT 1"); // Consulta simple para verificar la conexión
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo "Conexión a la base de datos exitosa.";
    } else {
        echo "No se pudo verificar la conexión.";
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>
