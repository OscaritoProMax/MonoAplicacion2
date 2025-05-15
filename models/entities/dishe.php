<?php

namespace App\models\entities;
use MonoApp\Models\Drivers\ConexDB;

class Dishes extends Model
{
    protected $id = 0;
    protected $description = '';
    protected $price = 0.0;
    protected $idCategory = '';

    public function all()   //esta funcion devuelve todos los platos de la base de datos
    {
        $conexDb = new ConexDB();
        $sql = "select * from dishes";
        $res = $conexDb->exeSQL($sql);
        $Platos = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $Dishes = new Dishes();
                $Dishes->set('id', $row['id']);
                $Dishes->set('description', $row['description']);
                $Dishes->set('price', $row['price']);
                $Dishes->set('idCategory', $row['idCategory']);
                array_push($Platos, $Dishes);
            }
        }
        $conexDb->close();
        return $Platos;
    }

    public function registrar()//esta funcion inserta un plato en la base de datos
    {
        $conexDb = new ConexDB();
        $sql = "insert into dishes (description, price, idCategory) values ";
        $sql .= "('" . $this->description . "'," . $this->price . "," . $this->idCategory . ")";
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }

    public function update()//esta funcion actualiza un plato en la base de datos
    {
        $conexDb = new ConexDB();
        $sql = "update dishes set description = '" . $this->description . "', price = " . $this->price . ", idCategory = " . $this->idCategory . " where id = " . $this->id;
        $res = $conexDb->exeSQL($sql);
        $conexDb->close();
        return $res;
    }

    public function delete() {
    $conexDb = new ConexDB();

    // Verificar si el plato está relacionado en los detalles de pedidos
    $sqlCheck = "SELECT COUNT(*) as total FROM order_details WHERE idDish = " . $this->id;
    $resCheck = $conexDb->exeSQL($sqlCheck);
    $row = $resCheck->fetch_assoc();

    if ($row['total'] > 0) {
        $conexDb->close();
        return false;  // No se puede eliminar porque está relacionado
    }

    // Procede a eliminar
    $sql = "DELETE FROM dishes WHERE id = " . $this->id;
    $res = $conexDb->exeSQL($sql);
    $conexDb->close();
    return $res;
}

    public function find(){//esta funcion busca un plato por su id en la base de datos
        $conexDb = new ConexDB();
        $sql = "select * from dishes where id = " . $this->id;
        $res = $conexDb->exeSQL($sql);
        $Dishes = null;
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $Dishes = new Dishes();
                $Dishes->set('id', $row['id']);
                $Dishes->set('description', $row['description']);
                $Dishes->set('price', $row['price']);
                $Dishes->set('idCategory', $row['idCategory']);
            }
        }
        $conexDb->close();
        return $Dishes;    
    }
}
