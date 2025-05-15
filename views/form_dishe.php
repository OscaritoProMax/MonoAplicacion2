<?php
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../models/entities/categories.php';
include '../controllers/Dishescontroller.php';

use App\controllers\DishesController;
use MonoApp\Models\Entities\Categories;

$controller = new DishesController();
$categorias = Categories::getAllDishe(); // trae el resultado crudo de la DB

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'idCategory' => $_POST['idCategory']
    ];

    $resultado = $controller->saveNewDishe($data);

    if ($resultado === 'yes') {
        header('Location: dishes.php');
        exit;
    } else {
        echo "Error al registrar el plato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Plato</title>
</head>
<body>
    <h1>Registrar nuevo plato</h1>
    <form method="post">
        <label>Descripción:</label>
        <input type="text" name="description" required><br>

        <label>Precio:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Categoría:</label>
        <select name="idCategory" required>
            <option value="">Seleccione...</option>
            <?php
            if ($categorias && $categorias->num_rows > 0) {
                while ($cat = $categorias->fetch_assoc()) {
                    echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                }
            }
            ?>
        </select><br><br>

        <button type="submit">Registrar</button>
        <a href="dishes.php">Cancelar</a>
    </form>
    <a href="../views/index.php">Volver a Menu Principal</a>
</body>
</html>
