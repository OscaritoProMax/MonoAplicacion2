<?php
require_once("../../models/entities/categories.php");
use MonoApp\Models\Entities\Categories;

if (isset($_GET['id'])) {
    $cat = new Categories();
    $cat->setId($_GET['id']);
    $cat->DeleteCategory();
}

header("Location: ../../?c=Categoriescontroller&m=index");
exit;
?>
