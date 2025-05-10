<h2>Categorías</h2>
<a href="?c=Categoriescontroller&m=form">Agregar nueva categoría</a>
<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= $cat['name'] ?></td>
            <td>
                <a href="?c=Categoriescontroller&m=form&id=<?= $cat['id'] ?>">Editar</a>
                <a href="views/actions/deletecategory.php?id=<?= $cat['id'] ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
