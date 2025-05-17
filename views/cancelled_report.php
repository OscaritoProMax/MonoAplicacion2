<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Órdenes</title>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="form-container">
        <h1>Reporte del <?= htmlspecialchars($startDate) ?> al <?= htmlspecialchars($endDate) ?></h1>

        <h2>Órdenes Anuladas</h2>

        <?php if (!empty($cancelledOrders)): ?>
            <table border="1">
                <tr>
                    <th>ID Orden</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($cancelledOrders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td><?= htmlspecialchars($order['dateOrder']) ?></td>
                    <td>$<?= number_format($order['total'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h3>Total Reembolsado: $<?= number_format($totalCancelled, 2) ?></h3>
        <?php else: ?>
            <p>No se encontraron órdenes anuladas en el rango seleccionado.</p>
        <?php endif; ?>

        <br>   
        <a href="../index.php" class="btn">Menú principal</a>
    </div>
</body>
</html>
