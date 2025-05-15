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
<style>
.estado-anulada {
    color: red;
    font-weight: bold;
    background-color: #f8d7da; /* rojo claro */
}
.estado-activa {
    color: green;
    font-weight: bold;
    background-color: #d4edda; /* verde claro */
}
table {
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 5px 10px;
}
</style>
</head>
<body>

<h1>Listado de Órdenes</h1>
<table cellpadding="5" cellspacing="0">
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
            <td class="<?= $isCancelled ? 'estado-anulada' : 'estado-activa' ?>"><?= $estado ?></td>
            <td>
                <table cellpadding="3" cellspacing="0">
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
                    <a href="actions/cancelorder.php?id=<?= $order->id ?>" onclick="return confirm('¿Anular esta orden?')">Anular Orden</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<br>
<a href="index.php">Volver al Menú Principal</a>

</body>
</html>
