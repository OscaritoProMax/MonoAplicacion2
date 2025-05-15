<?php
require_once __DIR__ . '/../models/drivers/conexDB.php';
$db = new \MonoApp\Models\Drivers\ConexDB();

// Consultar todas las órdenes con la mesa
$queryOrders = "
    SELECT o.id, o.dateOrder, o.total, t.name AS mesa
    FROM orders o
    JOIN restaurant_tables t ON o.idTable = t.id
    ORDER BY o.dateOrder DESC
";
$ordersResult = $db->exeSQL($queryOrders);
?>

<h1>Listado de Órdenes</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Mesa</th>
            <th>Total</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($order = $ordersResult->fetch_object()): ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->dateOrder ?></td>
            <td><?= $order->mesa ?></td>
            <td>$<?= number_format($order->total, 2) ?></td>
            <td>
                <table border="1" cellpadding="3" cellspacing="0">
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
                            <td><?= $detail->description ?></td>
                            <td><?= $detail->quantity ?></td>
                            <td>$<?= number_format($detail->price, 2) ?></td>
                            <td>$<?= number_format($subtotal, 2) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<br>
<a href="index.php">Volver al Menú Principal</a>
