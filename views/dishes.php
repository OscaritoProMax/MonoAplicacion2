<?php 
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../controllers/Dishescontroller.php';

use App\controllers\DishesController;

$controller = new DishesController();
$searchId = $_GET['search'] ?? null;

if ($searchId) {
    $plato = $controller->getDishe((int)$searchId);
    $platos = $plato ? [$plato] : [];
} else {
    $platos = $controller->getAllDishes();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Platos</title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/categories.css">
</head>
<body>
    <header class="main-header">
        <div class="logo"> Syntax Deli</div>
        <nav class="nav-menu">
            <a href="../views/index.php">Inicio</a>
            <a href="/MonoAplicacion2/views/dishes.php">Platos</a>
            <a href="/MonoAplicacion2/views/categories.php">Categorías</a>
        </nav>
    </header>

    <div class="container">
        <h2>Platos</h2>
        <a href="form_dishe.php" class="button-link">Crear Nuevo Plato</a>

        <div class="table-wrapper">
            <form method="get">
                <input type="number" name="search" placeholder="Buscar por ID" required>    
                <button type="submit" class="button-link">Buscar</button>
            </form>

            <table>
                <thead>
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
                            echo '  <td>' . $plato->get("id") . '</td>';
                            echo '  <td>' . $plato->get("description") . '</td>';
                            echo '  <td>' . $plato->get("price") . '</td>';
                            echo '  <td>' . $plato->get("idCategory") . '</td>';
                            echo '  <td>';
                            echo '      <a class="action-link" href="edit_dishe.php?id=' . $plato->get("id") . '">Editar</a> | ';
                            echo '      <a class="action-link" href="actions/deletedishes.php?id=' . $plato->get("id") . '" onclick="return confirm(\'¿Seguro que deseas eliminar este plato?\')">Eliminar</a>';
                            echo '  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No se encontraron platos.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <a class="button-link" href="../views/index.php">Volver a Menú Principal</a>
    </div>
</body>
</html>

