<?php
require_once __DIR__ . '/../models/drivers/conexDB.php';
$db = new \MonoApp\Models\Drivers\ConexDB();

// Leer órdenes anuladas desde archivo
$anuladas = [];
$filename = __DIR__ . '/actions/anuladas.txt';
if (file_exists($filename)) {
    $anuladas = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Consultar todas las órdenes con la mesa
$queryOrders = "
    SELECT o.id, o.dateOrder, o.total, t.name AS mesa
    FROM orders o
    JOIN restaurant_tables t ON o.idTable = t.id
    ORDER BY o.dateOrder DESC
";
$ordersResult = $db->exeSQL($queryOrders);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Listado de Órdenes</title>
    <link rel="stylesheet" href="/MonoAplicacion2/views/css/form.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://png.pngtree.com/thumb_back/fh260/background/20240425/pngtree-top-desk-with-blur-restaurant-background-wooden-table-image_15665383.jpg') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .main-container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 95%;
            margin: 30px auto;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1.form-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-footer {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .form-link {
            font-weight: bold;
            color: #5a2a82;
            font-size: 15px;
            text-decoration: none;
            background-color: #e0d2f4;
            padding: 10px 18px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .form-link:hover {
            background-color: #d1bdf0;
        }
    </style>
</head>
<body>

<div class="main-container">
    <h1 class="form-title">Listado de Órdenes</h1>

    <table class="table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Mesa</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Detalle</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($order = $ordersResult->fetch_object()): ?>
            <?php
            $isCancelled = in_array((string)$order->id, $anuladas, true);
            $estado = $isCancelled ? 'Anulada' : 'Activa';
            ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->dateOrder ?></td>
                <td><?= $order->mesa ?></td>
                <td>$<?= number_format($order->total, 2) ?></td>
                <td>
                    <span class="<?= $isCancelled ? 'estado-anulada' : 'estado-activa' ?>">
                        <?= $estado ?>
                    </span>
                </td>
                <td>
                    <table class="table-details">
                        <thead>
                            <tr>
                                <th>Plato</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryDetails = "
                                SELECT d.description, od.quantity, od.price
                                FROM order_details od
                                JOIN dishes d ON od.idDish = d.id
                                WHERE od.idOrder = {$order->id}
                            ";
                            $detailsResult = $db->exeSQL($queryDetails);
                            while ($detail = $detailsResult->fetch_object()):
                                $subtotal = $detail->quantity * $detail->price;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($detail->description) ?></td>
                                <td><?= $detail->quantity ?></td>
                                <td>$<?= number_format($detail->price, 2) ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </td>
                <td>
                    <?php if (!$isCancelled): ?>
                        <a href="actions/cancelorder.php?id=<?= $order->id ?>"
                           onclick="return confirm('¿Anular esta orden?')"
                           class="form-button cancel-button">
                            ❌ Anular
                        </a>
                    <?php else: ?>
                        <span class="form-text-muted">-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="btn-footer">
        <a href="index.php" class="form-link">🔙 Volver al Menú Principal</a>
    </div>
</div>

</body>
</html>
