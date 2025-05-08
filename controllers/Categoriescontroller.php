<?php
require_once("models/entities/categories.php");

class CategoriesController {
    public function index() {
        $categories = MonoApp\Models\Entities\Categories::getAll();
        include("views/categories.php");
    }

    public function form($id = null) {
        $category = null;
        if ($id) {
            $category = MonoApp\Models\Entities\Categories::getById($id);
        }
        include("views/form_category.php");
    }
}
