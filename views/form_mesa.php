<?php
include_once __DIR__ . '/../models/entities/mesa.php';
use App\models\Mesa;

$mesa = null;
$isEditing = false;

if (!empty($_GET['id'])) {
    $mesaModel = new Mesa();
    $mesa = $mesaModel->find($_GET['id']);
    $isEditing = $mesa && is_object($mesa);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $isEditing ? 'Editar Mesa' : 'Registrar Nueva Mesa' ?></title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css">
</head>
<body>
    <div class="form-container">
        <h2><?= $isEditing ? 'Editar Mesa' : 'Registrar Nueva Mesa' ?></h2>

        <form action="actions/savemesa.php" method="POST">
            <?php if ($isEditing): ?>
                <input type="hidden" name="id" value="<?= $mesa->id ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required
                       value="<?= $isEditing ? htmlspecialchars($mesa->name) : '' ?>">
            </div>

            <div class="form-actions">
                <button type="submit"><?= $isEditing ? '💾 Actualizar' : '➕ Guardar' ?></button>
                <a class="back-button" href="mesas.php">🔙 Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
