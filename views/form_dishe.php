<?php
require_once '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../controllers/DishesController.php';

use App\controllers\DishesController;
$isEdit = isset($dishe); // variable para determinar si es edición
$action = $isEdit ? "actions/savedishes.php?edit=1" : "actions/savedishes.php";
$controller = new DishesController();

$id = empty($_GET['id']) ? null : $_GET['id'];
$persona = empty($id) ? null : $controller->getDishe($id);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo plato</title>
</head>

<body>
    <h1>
        <?php
        if (empty($id)) {
            echo 'Registrar Plato';
        } else {
            echo 'Modificar Plato';
        }
        ?>
    </h1>
    <br>
    <?php
        require_once '../models/drivers/conexDB.php';
        $conex = new \App\models\drivers\ConexDB();
        $sql = "SELECT * FROM categories";
        $result = $conex->exeSQL($sql);
        $categories = [];

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $conex->close();
        ?>
    <form action="<?= $action ?>" method="POST">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= $dishe->get('id') ?>">
    <?php endif; ?>

    <label for="description">Descripción:</label>
    <input type="text" name="description" id="description" required
           value="<?= $isEdit ? $dishe->get('description') : '' ?>">

    <label for="price">Precio:</label>
    <input type="number" step="0.01" name="price" id="price" required
           value="<?= $isEdit ? $dishe->get('price') : '' ?>">

           <?php if (!$isEdit): ?>
             <label for="idCategory">Categoría:</label>
                <select name="idCategory" id="idCategory" required>
                  <?php foreach ($categories as $cat): ?>
                 <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
                <p><strong>Categoría:</strong> <?= $dishe->get('idCategory') ?> (no editable)</p>
            <?php endif; ?>

    <button type="submit"><?= $isEdit ? 'Actualizar' : 'Registrar' ?> Plato</button>
</form>
    <a href="dishes.php">Volver</a>
</body>

</html>