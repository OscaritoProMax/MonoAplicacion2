<?php
include '../../models/drivers/conexDB.php';
include '../../models/entities/model.php';
include '../../models/entities/dishes.php';
include '../../controllers/Dishescontroller.php';

use App\controllers\DishesController;

$controller = new DishesController();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('location: ../dishes.php');
}
$res = empty($_POST['id'])
    ? $controller->saveNewDishe($_POST)
    : $controller->updateDishe($_POST);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado operación</title>
</head>

<body>
    <h1>Resultado de la operación</h1>
    <?php
    if ($res == 'yes') {
        echo '<p>Datos guardados</p>';
    } else {
        echo  '<p>No se pudo guardar los datos</p>';
    }
    ?>
    <br>
    <a href="../personas.php">Volver</a>
</body>

</html>