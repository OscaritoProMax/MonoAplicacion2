
<?php

namespace MonoApp\Models\Entities;
use App\models\drivers\ConexDB;

class Categories
{
   protected $id = 0;
   protected $name = '';

public function AddCategory()
{
    $conexDb = new ConexDB();
    $sql = "insert into categories (name) values ";
    $sql .= "('" . $this->name . "')";
    $res = $conexDb->exeSQL($sql);
    $conexDb->close();
    return $res;

}

}