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

        <h2>Órdenes no anuladas</h2>
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
                    <strong>ID:</strong> <?= $order['id'] ?><br>
                    <strong>Fecha:</strong> <?= $order['dateOrder'] ?><br>
                    <strong>Total:</strong> $<?= number_format($order['total'], 2, ',', '.') ?><br>

                    <details style="margin-top: 5px;">
                        <summary>Detalles de la orden</summary>
                        <ul>
                            <?php foreach ($order['details'] as $detail): ?>
                                <li>
                                    <?= htmlspecialchars($detail['description']) ?> - 
                                    Cantidad: <?= $detail['quantity'] ?> - 
                                    Precio: $<?= number_format($detail['price'], 2, ',', '.') ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </details>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay órdenes en el rango de fechas seleccionado.</p>
        <?php endif; ?>

        <h2>Total recaudado</h2>
        <p><strong>$<?= number_format($total, 2, ',', '.') ?></strong></p>

        <h2>Platos más vendidos</h2>
        <?php if ($dishesRanking && $dishesRanking->num_rows > 0): ?>
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Plato</th>
                        <th>Cantidad Vendida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dishesRanking as $dish): ?>
                        <tr>
                            <td><?= htmlspecialchars($dish['plato']) ?></td>
                            <td><?= htmlspecialchars($dish['total_vendido']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se vendieron platos en este rango.</p>
        <?php endif; ?>

        <br>
        
        <a href="../index.php" class="btn">Menú principal</a>
    </div>
</body>
</html>

