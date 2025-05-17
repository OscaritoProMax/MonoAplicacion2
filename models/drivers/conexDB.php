<?php
namespace MonoApp\Models\Drivers;

use mysqli;

class ConexDB {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dataBase = 'proyecto_2_db';

    private $conex = null;

    public function __construct() {
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->dataBase
        );

        if ($this->conex->connect_error) {
            die("Error de conexión: " . $this->conex->connect_error);
        }

        // Verificación automática de la columna isCancelled en orders
        $this->verificarColumnaIsCancelled();
    }

    public function lastInsertId() {
        return $this->conex->insert_id;
    }
    
    private function verificarColumnaIsCancelled() {
        $sql = "SHOW COLUMNS FROM orders LIKE 'isCancelled';";
        $result = $this->conex->query($sql);
        if ($result && $result->num_rows === 0) {
            $alter = "ALTER TABLE orders ADD COLUMN isCancelled TINYINT(1) NOT NULL DEFAULT 0;";
            $this->conex->query($alter);
        }
    }

    public function close() {
        $this->conex->close();
    }

    public function exeSQL($sql) {
        return $this->conex->query($sql);
    }
}




