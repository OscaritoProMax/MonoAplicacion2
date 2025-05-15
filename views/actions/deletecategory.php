<?php
session_start();

require_once("../../models/entities/categories.php");
use MonoApp\Models\Entities\Categories;

if (isset($_GET['id'])) {
    $cat = new Categories();
    $cat->setId($_GET['id']);

    // Verificamos si se puede eliminar (sin platos relacionados)
    $res = $cat->DeleteCategory();

    if ($res) {
        $_SESSION['msg'] = '✅ Categoría eliminada correctamente.';
    } else {
        $_SESSION['msg'] = '❌ No se pudo eliminar la categoría porque tiene platos relacionados.';
    }
} else {
    $_SESSION['msg'] = '❌ ID de categoría no proporcionado.';
}

header("Location: ../categories.php");
exit;
