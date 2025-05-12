<?php
require_once("models/entities/categories.php");
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

}

