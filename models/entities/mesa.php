<?php
namespace App\models;

use App\models\entities\Model;
use MonoApp\Models\Drivers\ConexDB;

require_once __DIR__ . '/../drivers/conexDB.php';
require_once __DIR__ . '/model.php';

class Mesa extends Model {
    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = new ConexDB(); // Conexión establecida con tu clase
    }

    public function all() {
        $query = "SELECT * FROM restaurant_tables ORDER BY id DESC;";
        return $this->db->exeSQL($query);
    }

    public function registrar() {
        $query = "INSERT INTO restaurant_tables (name) VALUES ('{$this->nombre}');";
        return $this->db->exeSQL($query);
    }

    public function update() {
        $query = "UPDATE restaurant_tables SET name = '{$this->nombre}' WHERE id = {$this->id};";
        return $this->db->exeSQL($query);
    }

    public function delete($id = null) {
        $id = $id ?? $this->id;
        $query = "DELETE FROM restaurant_tables WHERE id = $id;";
        return $this->db->exeSQL($query);
    }

    public function canDelete($id) {
        $query = "SELECT COUNT(*) as count FROM orders WHERE idTable = $id;";
        $result = $this->db->exeSQL($query);
        $row = $result->fetch_assoc();
        return $row['count'] == 0;
    }

    public function find($id) {
        $query = "SELECT * FROM restaurant_tables WHERE id = $id LIMIT 1;";
        $result = $this->db->exeSQL($query);
        return $result->fetch_object();
    }
}
