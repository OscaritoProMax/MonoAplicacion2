<?php
include '../../models/drivers/conexDB.php';
include '../../models/entities/model.php';
include '../../models/entities/dishe.php';
include '../../controllers/DishesController.php';

use App\controllers\DishesController;

$controller = new DishesController();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$res = $id ? $controller->removeDishe($id) : 'empty';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Eliminar Plato</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .msg-ok { color: green; font-weight: bold; }
        .msg-error { color: red; font-weight: bold; }
    </style>
    <!-- Redirige a dishes.php después de 3 segundos -->
    <meta http-equiv="refresh" content="3; url=../dishes.php" />
</head>
<body>
    <h1>Resultado de la operación</h1>
    <?php
    switch ($res) {
        case 'yes':
            echo '<p class="msg-ok">Plato eliminado correctamente. Redirigiendo...</p>';
            break;
        case 'not':
            echo '<p class="msg-error">No se pudo eliminar el plato. Puede estar relacionado con un pedido.</p>';
            break;
        default:
            echo '<p class="msg-error">El plato no existe o no se proporcionó ID.</p>';
            break;
    }
    ?>
    <p>Si no eres redirigido automáticamente, <a href="../dishes.php">haz clic aquí</a>.</p>
</body>
</html>
