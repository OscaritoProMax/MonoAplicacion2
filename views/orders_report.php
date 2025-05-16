<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte de Órdenes</title>
    <link rel="stylesheet" href="css/menuprincipal.css" />
</head>
<body>
    <div class="container">
        <h1>Reporte de Órdenes desde <?= htmlspecialchars($startDate) ?> hasta <?= htmlspecialchars($endDate) ?></h1>

        <?php if (empty($orders)): ?>
            <p>No se encontraron órdenes en este rango de fechas.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card" style="border:1px solid #ccc; margin-bottom: 20px; padding: 10px;">
                    <h3>Orden #<?= $order['id'] ?> - Mesa <?= $order['idTable'] ?></h3>
                    <p><strong>Fecha:</strong> <?= $order['dateOrder'] ?></p>
                    <p><strong>Total:</strong> $<?= number_format($order['total'], 0, ',', '.') ?></p>
                    <p><strong>Estado:</strong> <span style="color:green;">Activa</span></p>

                    <h4>Detalle:</h4>
                    <table border="1" cellpadding="5" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Plato</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['details'] as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['description']) ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>$<?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td>$<?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="../report_form.php">Nueva Consulta</a> | <a href="../orders.php">Volver a Órdenes</a>
    </div>
</body>
</html>
