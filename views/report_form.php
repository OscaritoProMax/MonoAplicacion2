<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte de Órdenes por Fecha</title>
    <link rel="stylesheet" href="css/menuprincipal.css" />
</head>
<body>
    <div class="container">
        <h1>Reporte de Órdenes por Fecha</h1>

        <form method="POST" action="actions/reportorders.php">
            <label>Fecha inicio:</label>
            <input type="date" name="startDate" required>

            <label>Fecha fin:</label>
            <input type="date" name="endDate" required>

            <button type="submit">Generar Reporte</button>
        </form>

        <br>
        <a href="orders.php">Volver a Órdenes</a>
    </div>
</body>
</html>
