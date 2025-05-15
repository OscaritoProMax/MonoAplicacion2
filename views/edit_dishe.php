<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../models/entities/categories.php';
include '../controllers/Dishescontroller.php';

use App\controllers\DishesController;
use MonoApp\Models\Entities\Categories;

$controller = new DishesController();
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID de plato no proporcionado.";
    exit;
}

$plato = $controller->getDishe($id);
if (!$plato) {
    echo "Plato no encontrado.";
    exit;
}

$categorias = Categories::getAll();

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'idCategory' => $_POST['idCategory']
    ];

    $resultado = $controller->updateDishe($data);

    if ($resultado === 'yes') {
        header('Location: dishes.php');
        exit;
    } else {
        echo "Error al actualizar el plato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Plato</title>
</head>
<body>
    <h1>Editar Plato</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $plato->get('id'); ?>">

        <label>Descripción:</label>
        <input type="text" name="description" value="<?php echo $plato->get('description'); ?>" required><br>

        <label>Precio:</label>
        <input type="number" name="price" value="<?php echo $plato->get('price'); ?>" step="0.01" required><br>

        <label>Categoría:</label>
        <select name="idCategory" required>
            <option value="">Seleccione...</option>
            <?php
            if ($categorias && $categorias->num_rows > 0) {
                while ($cat = $categorias->fetch_assoc()) {
                    $selected = $cat['id'] == $plato->get('idCategory') ? 'selected' : '';
                    echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . $cat['name'] . '</option>';
                }
            }
            ?>
        </select><br><br>

        <button type="submit">Actualizar</button>
        <a href="dishes.php">Cancelar</a>
    </form>
</body>
</html>
