<?php
class Database {
    private $pdo;

    public function __construct() {
        $config = require(__DIR__ . '/../../config/config.php');
        
        $encryptOption = $config['db_encrypt'] ? 'Encrypt=yes' : 'Encrypt=no';
        $trustedCertOption = $config['db_trusted_cert'] ? 'TrustServerCertificate=yes' : 'TrustServerCertificate=no';

        $dsn = "sqlsrv:Server={$config['db_host']};Database={$config['db_name']};$encryptOption;$trustedCertOption";
        
        try {
            $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->handleError("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    // Método para ejecutar consultas SQL
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            $this->handleError("Query failed: " . $e->getMessage());
        }
    }

    // Método para obtener resultados de una consulta SELECT
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un único resultado
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para manejar errores y registrar logs
    private function handleError($message) {
        // Registrar el error en un archivo de log
        error_log($message, 3, __DIR__ . '/../../logs/error.log');
        die($message);
    }
}
