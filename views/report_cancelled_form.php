<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte de Órdenes Canceladas</title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css" />
</head>
<body>
    <div class="form-container">
        <h1>Reporte de Ordenes Canceladas</h1>

        <form action="actions/reportcancelled.php" method="POST">
            <label for="startDate">Fecha inicio:</label>
            <input type="date" name="startDate" required>
            
            <label for="endDate">Fecha fin:</label>
            <input type="date" name="endDate" required>

            <input type="submit" value="Generar Reporte">
        </form>

        <br>

        <div style="display: flex; gap: 10px;">
            <a href="orders.php" class="btn">Volver a Órdenes</a>
            <a href="index.php" class="btn">Volver al Menú Principal</a>
        </div>
    </div>
</body>
</html>