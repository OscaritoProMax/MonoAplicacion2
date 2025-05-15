<?php
require_once __DIR__ . '/../models/entities/categories.php';
require_once __DIR__ . '/../models/drivers/ConexDB.php';


class CategoriesController {

    public function index() {
        $categories = MonoApp\Models\Entities\Categories::getAll();
        include("views/categories.php");
    }

    public function form() {
    $category = null;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $category = \MonoApp\Models\Entities\Categories::getById($_GET['id']);
    }

    include("views/form_category.php");
}


    public function save() {
        $category = new \MonoApp\Models\Entities\Categories();
        $category->setName($_POST['name']);

        if (!empty($_POST['id'])) {
            $category->setId($_POST['id']);
            $category->UpdateCategory();
        } else {
            $category->AddCategory();
        }

        header("Location: ?c=Categoriescontroller&m=index");
    }

    public static function getAll() {
        $conex = new \MonoApp\Models\Drivers\ConexDB();
        $sql = "SELECT * FROM categories";
        $result = $conex->exeSQL($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new \MonoApp\Models\Entities\Categories($row['id'], $row['name']);
        }

        $conex->close();
        return $categories;
    }

}

