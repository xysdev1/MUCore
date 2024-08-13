<?php
require_once __DIR__ . '/../../system/database/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($username, $password) {
        // Consulta a la base de datos usando SQL Server
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);  // Nota: Considera usar un método seguro para manejar contraseñas
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Otros métodos relacionados con usuarios
}
