<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte de Órdenes por Fecha</title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css" />
</head>
<body>
    <div class="form-container">
        <h1>Reporte de Órdenes por Fecha</h1>

        <form method="POST" action="actions/reportorders.php">
            <label for="startDate">Fecha inicio:</label>
            <input type="date" name="startDate" required>

            <label for="endDate">Fecha fin:</label>
            <input type="date" name="endDate" required>

            <button type="submit" class="btn">Generar Reporte</button>
        </form>

        <br>

        <div style="display: flex; gap: 10px;">
            <a href="orders.php" class="btn">Volver a Órdenes</a>
            <a href="index.php" class="btn">Volver al Menú Principal</a>
        </div>
    </div>
</body>
</html>

