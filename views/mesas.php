<h1>Mesas Registradas</h1>
<?php
include_once __DIR__ . '/../models/entities/mesa.php';
use App\models\Mesa;

$mesaModel = new Mesa();
$mesas = $mesaModel->all();
?>

<a href="form_mesa.php" class="btn">Registrar Nueva Mesa</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mesa = $mesas->fetch_object()): ?>
            <tr>
                <td><?= $mesa->id ?></td>
                <td><?= $mesa->name ?></td>
                <td>
                    <a href="form_mesa.php?id=<?= $mesa->id ?>">Editar</a>
                    <a href="actions/deletemesa.php?id=<?= $mesa->id ?>"
                       onclick="return confirm('¿Estás seguro de eliminar esta mesa?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<br>
<a href="index.php">Volver a Menú Principal</a>
