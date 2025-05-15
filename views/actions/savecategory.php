<?php
session_start();
require_once("../../models/entities/categories.php");
use MonoApp\Models\Entities\Categories;

$cat = new Categories();
$cat->setName($_POST['name']);

if (!empty($_POST['id'])) {
    $cat->setId($_POST['id']);
    $res = $cat->UpdateCategory();
    $_SESSION['msg'] = $res ? '✅ Categoría actualizada correctamente.' : '❌ Error al actualizar la categoría.';
} else {
    $res = $cat->AddCategory();
    $_SESSION['msg'] = $res ? '✅ Categoría agregada correctamente.' : '❌ Error al agregar la categoría.';
}

header("Location: ../categories.php");
exit;
