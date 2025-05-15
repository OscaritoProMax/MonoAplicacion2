<?php
include_once __DIR__ . '/../models/entities/mesa.php';
use App\models\Mesa;

$mesa = null;
if (!empty($_GET['id'])) {
    $mesaModel = new Mesa();
    $mesa = $mesaModel->find($_GET['id']);
}
?>

<?php if ($mesa && is_object($mesa)): ?>
    <h1>Editar Mesa</h1>
    <form action="actions/savemesa.php" method="POST">
        <input type="hidden" name="id" value="<?= $mesa->id ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $mesa->name ?>" required>
        <input type="submit" value="Actualizar">
    </form>
<?php else: ?>
    <h1>Registrar Nueva Mesa</h1>
    <form action="actions/savemesa.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <input type="submit" value="Guardar">
    </form>
<?php endif; ?>

<br>
<a href="mesas.php">Volver</a>
