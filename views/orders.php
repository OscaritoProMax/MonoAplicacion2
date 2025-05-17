<?php
require_once __DIR__ . '/../models/drivers/conexDB.php';
$db = new \MonoApp\Models\Drivers\ConexDB();

$queryOrders = "
    SELECT o.id, o.dateOrder, o.total, o.isCancelled, t.name AS mesa
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

        .form-button {
            padding: 6px 10px;
            margin-top: 5px;
            font-size: 14px;
            background-color: #d8d1e9;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #c5b2e0;
        }

        .factura-box {
            background-color: #fff;
            padding: 20px;
            border: 2px dashed #888;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            font-family: 'Courier New', Courier, monospace;
        }

        .factura-box h2 {
            margin-top: 0;
            text-align: center;
            color: #5a2a82;
        }

        .factura-box table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .factura-box th, .factura-box td {
            padding: 6px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
    <script>
        function toggleFactura(id) {
            const elem = document.getElementById(id);
            elem.style.display = (elem.style.display === 'none' ? 'table-row' : 'none');
        }
    </script>
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
                $isCancelled = $order->isCancelled == 1;
                $estado = $isCancelled ? 'Anulada' : 'Activa';
            ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->dateOrder ?></td>
                <td><?= $order->mesa ?></td>
                <td>$<?= number_format($order->total, 2) ?></td>
                <td><span class="<?= $isCancelled ? 'estado-anulada' : 'estado-activa' ?>"><?= $estado ?></span></td>
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
                           class="form-button cancel-button">❌ Anular</a><br>
                    <?php else: ?>
                        <span class="form-text-muted">-</span><br>
                    <?php endif; ?>
                    <button onclick="toggleFactura('factura-<?= $order->id ?>')" class="form-button">🧾 Ver Factura</button>
                </td>
            </tr>
            <tr id="factura-<?= $order->id ?>" style="display:none;">
                <td colspan="7">
                    <div class="factura-box">
                        <h2>🍽️ Restaurante Syntax Deli</h2>
                        <p>NIT: 900123456-7</p>
                        <p>Dirección: Calle 45 #123, Bogotá</p>
                        <p>Teléfono: (1) 456 7890</p>
                        <hr>
                        <p><strong>Factura N°:</strong> <?= $order->id ?></p>
                        <p><strong>Fecha:</strong> <?= $order->dateOrder ?></p>
                        <p><strong>Mesa:</strong> <?= $order->mesa ?></p>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <th>Plato</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
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
                                $total = 0;
                                while ($detail = $detailsResult->fetch_object()):
                                    $subtotal = $detail->quantity * $detail->price;
                                    $total += $subtotal;
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
                        <hr>
                        <h3>Total: $<?= number_format($total, 2) ?></h3>
                        <p style="font-style: italic;">Gracias por su visita. ¡Vuelva pronto!</p>
                    </div>
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
