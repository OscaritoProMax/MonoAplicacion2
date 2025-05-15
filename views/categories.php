<?php
session_start();
include '../models/entities/categories.php';
use MonoApp\Models\Entities\Categories;

$categories = Categories::getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
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
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="success-message"><?= $_SESSION['msg'] ?></div>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <h2>Categorías</h2>
    <a class="button-link" href="form_category.php">Agregar nueva categoría</a>

    <div class="table-wrapper">
        <table>
            <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['name']) ?></td>
                    <td>
                        <a class="action-link" href="form_category.php?id=<?= $cat['id'] ?>">Editar</a> |
                        <a class="action-link" href="actions/deletecategory.php?id=<?= $cat['id'] ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <br>
    <a class="button-link" href="index.php">Volver al menú principal</a>
</div>
</body>
</html>

 