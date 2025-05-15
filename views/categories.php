<?php
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/categories.php';
include '../controllers/Categoriescontroller.php';
require_once '../controllers/Categoriescontroller.php';

$controller = new CategoriesController();
$categories = $controller->getAll();

if (!isset($categories) || !is_array($categories)) {
    $categories = [];
}
?>

<h2>Categorías</h2>
<a href="?c=Categoriescontroller&m=form">Agregar nueva categoría</a>

<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($categories as $cat): ?>
        <tr>
           <td><?= $cat->getId()?></td>
            <td><?= $cat->getName() ?></td>
            <td>
                <a href="?c=Categoriescontroller&m=form&id=<?= $cat->getId() ?>">Editar</a>
                <a href="views/actions/deletecategory.php?id=<?= $cat->getId() ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
