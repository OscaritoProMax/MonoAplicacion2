<h2><?= isset($category) ? 'Editar' : 'Nueva' ?> Categoría</h2>
<form action="views/actions/savecategory.php" method="post">
    <input type="hidden" name="id" value="<?= $category['id'] ?? '' ?>">
    <label>Nombre:</label>
    <input type="text" name="name" required value="<?= $category['name'] ?? '' ?>">
    <button type="submit">Guardar</button>
</form>
<a href="?c=Categoriescontroller&m=index">Volver</a>
