<?php
session_start();
include '../models/entities/categories.php';
use MonoApp\Models\Entities\Categories;

$categories = Categories::getAll();

if (isset($_SESSION['msg'])) {
    echo '<div style="padding:10px; background:#d4edda; color:#155724; border:1px solid #c3e6cb; margin-bottom:15px; border-radius:4px;">'
        . $_SESSION['msg'] . '</div>';
    unset($_SESSION['msg']);
}
?>


<h2>Categorías</h2>
<a href="form_category.php">Agregar nueva categoría</a>

<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php while ($cat = $categories->fetch_assoc()): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td>
                <a href="form_category.php?id=<?= $cat['id'] ?>">Editar</a> |
                <a href="actions/deletecategory.php?id=<?= $cat['id'] ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="index.php">Volver al menú principal</a>
 