<?php
include '../models/entities/categories.php';
use MonoApp\Models\Entities\Categories;

$category = null;
$isEditing = false;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $category = Categories::getById($_GET['id']);
    $isEditing = true;
}
?>

<h2><?= $isEditing ? 'Editar' : 'Agregar' ?> Categoría</h2>

<form method="POST" action="actions/savecategory.php">
    <?php if ($isEditing): ?>
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <?php endif; ?>

    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" required
           value="<?= $isEditing ? htmlspecialchars($category['name']) : '' ?>">

    <br><br>
    <button type="submit"><?= $isEditing ? '💾 Actualizar' : '➕ Guardar' ?></button>
    <a href="categories.php">🔙 Volver</a>
</form>
