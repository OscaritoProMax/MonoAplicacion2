<?php 
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../controllers/Dishescontroller.php';

use App\controllers\DishesController;

$controller = new DishesController();

// Verificar si se está buscando un ID específico
$searchId = $_GET['search'] ?? null;

if ($searchId) {
    $plato = $controller->getDishe((int)$searchId); // Corrección del método y variable
    $platos = $plato ? [$plato] : [];
} else {
    $platos = $controller->getAllDishes();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platos</title>
</head>

<body>
    <h1>Platos</h1>
    <a href="form_dishe.php">Crear</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <td colspan="5">
                    <form method="get">
                        <input type="number" name="search" placeholder="Buscar por ID" required>    
                        <button type="submit">Buscar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($platos)) {
                foreach ($platos as $plato) {
                    echo '<tr>';
                    echo '  <td>' . $plato->get('id') . '</td>';
                    echo '  <td>' . $plato->get('description') . '</td>';
                    echo '  <td>' . $plato->get('price') . '</td>';
                    echo '  <td>' . $plato->get('idCategory') . '</td>';
                    echo '  <td>';
                    echo '      <a href="edit_dishe.php?id=' . $plato->get('id') . '">Editar</a> | ';
                    echo '      <a href="actions/deletedishes.php?id=' . $plato->get('id') . '" onclick="return confirm(\'¿Seguro que deseas eliminar este plato?\')">Eliminar</a>';
                    echo '  </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No se encontraron platos.</td></tr>';
            }
            ?>
            <br>
            <a href="../views/index.php">Volver a Menu Principal</a>
        </tbody>
    </table>
</body>

</html>
