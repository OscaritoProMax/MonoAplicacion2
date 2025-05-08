<?php
require_once '../../models/entities/dishe.php';
require_once '../../controllers/Dishescontroller.php';

use App\controllers\DishesController;

$controller = new DishesController();

// Validar campos obligatorios
if (!isset($_POST['description'], $_POST['price'])) {
    echo "Faltan campos obligatorios";
    exit;
}

// Si es edición
if (isset($_GET['edit']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $data = [
        'id' => $id,
        'description' => $description,
        'price' => $price
    ];

    $result = $controller->updateDishe($data);
    echo $result === 'yes' ? "Plato actualizado correctamente" : "Error al actualizar";
} else {
    // Nuevo plato
    if (!isset($_POST['idCategory'])) {
        echo "Debe seleccionar una categoría";
        exit;
    }

    $description = $_POST['description'];
    $price = $_POST['price'];
    $idCategory = $_POST['idCategory'];

    $data = [
        'description' => $description,
        'price' => $price,
        'idCategory' => $idCategory
    ];

    $result = $controller->saveNewDishe($data);
    echo $result === 'yes' ? "Plato registrado correctamente" : "Error al registrar";
}
?>

<a href="../views/dishes.php">Volver a la lista de platos</a>
 