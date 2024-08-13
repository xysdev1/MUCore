<?php
class Database {
    private $pdo;

    public function __construct() {
        $config = require(__DIR__ . '/../../config/config.php');
        $dsn = "sqlsrv:Server={$config['db_host']};Database={$config['db_name']}";
        
        try {
            $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
