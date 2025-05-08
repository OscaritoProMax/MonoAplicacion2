<?php
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../controllers/Dishescontroller.php';

use App\controllers\DishesController;


$controller = new DishesController();
$platos = $controller->getAllDishes();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dishes</title>
</head>

<body>
    <h1>Personas</h1>
    <a href="form_dishe.php">Crear</a>
    <table>
        <thead>
            <tr>
                <td>
                    <form>
                        <input type="text" name="search" placeholder="Buscar por nombre" require>
                        <button type="submit">Buscar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <th>Precio</th>
                <th>Edad</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($platos as $plato) {
                echo '<tr>';
                echo '  <td>' . $plato->get('description') . '</td>';
                echo '  <td>' . $plato->get('price') . '</td>';
                echo '  <td>' . $plato->get('idCategory') . '</td>';
                echo '  </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>