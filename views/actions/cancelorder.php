<?php
require_once '../../models/entities/order.php';


use App\models\entities\Order;

$redirect = "../orders.php";
$mensaje = "";

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $orderModel = new Order();
    $orderModel->cancelOrder($id);
    $mensaje = "Orden anulada correctamente.";
} else {
    $mensaje = "ID de orden no especificado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Anulando Orden...</title>
    <meta http-equiv="refresh" content="2;url=<?= $redirect ?>" />
</head>
<body style="font-family:sans-serif; text-align:center; margin-top:50px;">
    <h2><?= htmlspecialchars($mensaje) ?></h2>
    <p>Redirigiendo en 2 segundos...</p>
</body>
</html>
