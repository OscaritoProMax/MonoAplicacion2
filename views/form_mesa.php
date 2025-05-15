<?php if (isset($mesa) && is_object($mesa)): ?>
    <h1>Editar Mesa</h1>
    <form action="index.php?controller=Mesa&action=update" method="POST">
        <input type="hidden" name="id" value="<?= $mesa->id ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $mesa->name ?>" required>
        <input type="submit" value="Actualizar">
    </form>
<?php else: ?>
    <h1>Registrar Nueva Mesa</h1>
    <form action="index.php?controller=Mesa&action=save" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <input type="submit" value="Guardar">
    </form>
<?php endif; ?>
