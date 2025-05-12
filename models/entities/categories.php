<?php
namespace MonoApp\Models\Entities;
require_once(__DIR__ . '/../drivers/ConexDB.php');
use MonoApp\Models\Drivers\ConexDB;


class Categories
{
    protected $id = 0;
    protected $name = '';

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function AddCategory() {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO categories (name) VALUES ('" . $this->name . "')";
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }

    public function UpdateCategory() {
        $conexDb = new ConexDB();
        $sql = "UPDATE categories SET name = '" . $this->name . "' WHERE id = " . $this->id;
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }

    public function DeleteCategory() {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM categories WHERE id = " . $this->id;
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }

    public static function getAll() {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM categories";
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }
    
    public static function getById($id) {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM categories WHERE id = $id";
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return isset($res[0]) ? (object)$res[0] : null;
    }

}
?>
