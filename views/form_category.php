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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $isEditing ? 'Editar' : 'Agregar' ?> Categoría</title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css">
</head>
<body>
    <div class="form-container">
        <h2><?= $isEditing ? 'Editar' : 'Agregar' ?> Categoría</h2>

        <form method="POST" action="actions/savecategory.php">
            <?php if ($isEditing): ?>
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" required
                       value="<?= $isEditing ? htmlspecialchars($category['name']) : '' ?>">
            </div>

            <div class="form-actions">
                <button type="submit"><?= $isEditing ? '💾 Actualizar' : '➕ Guardar' ?></button>
                <a class="back-button" href="categories.php">🔙 Volver</a>
            </div>
        </form>
    </div>
</body>
</html>


