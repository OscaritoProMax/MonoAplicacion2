<?php
include_once __DIR__ . '/../models/entities/mesa.php';
use App\models\Mesa;

$mesaModel = new Mesa();
$mesas = $mesaModel->all();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mesas</title>
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
        <h2>Mesas</h2>
        <a href="form_mesa.php" class="button-link">Registrar Nueva Mesa</a>

        <div class="table-wrapper">
            <table>
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
                                <a class="action-link" href="form_mesa.php?id=<?= $mesa->id ?>">Editar</a> |
                                <a class="action-link" href="actions/deletemesa.php?id=<?= $mesa->id ?>" onclick="return confirm('¿Estás seguro de eliminar esta mesa?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a class="button-link" href="index.php">Volver a Menú Principal</a>
    </div>
</body>
</html>
