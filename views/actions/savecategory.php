<?php
require_once("../../models/entities/categories.php");
use MonoApp\Models\Entities\Categories;

$cat = new Categories();
$cat->setName($_POST['name']);
if (!empty($_POST['id'])) {
    $cat->setId($_POST['id']);
    $cat->UpdateCategory();
} else {
    $cat->AddCategory();
}

header("Location: ../../?c=Categoriescontroller&m=index");
exit;
?>
