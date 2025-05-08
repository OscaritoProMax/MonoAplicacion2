<?php
include '../models/drivers/conexDB.php';
include '../models/entities/model.php';
include '../models/entities/dishe.php';
include '../controllers/DishesController.php';

use App\controllers\DishesController;

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
    <form action="actions/savePerson.php" method="post">
        <?php
        if (!empty($id)) {
            echo '<input type="hidden" name="id" value="' . $id . '">';
        }
        ?>
        <div>
            <label for="juju">Nombre</label>
            <input type="text" id="namePerson" name="namePerson" 
            value="<?php echo empty($persona) ? '' : $persona->get('nombre') ?>" required>
        </div>
        <div>
            <label for="emailPerson">Email</label>
            <input type="email" id="emailPerson" name="emailPerson" 
            value="<?php echo empty($persona) ? '' : $persona->get('email') ?>" required>
        </div>
        <div>
            <label for="agePerson">Edad</label>
            <input type="number" id="agePerson" name="agePerson" 
            value="<?php echo empty($persona) ? '' : $persona->get('edad') ?>" min="1" required>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
    <a href="dishes.php">Volver</a>
</body>

</html>