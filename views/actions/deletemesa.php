<?php
require_once '../../models/entities/mesa.php';
use App\models\Mesa;

// Conexión manual a la base (para eliminar pedidos primero)
require_once '../../models/drivers/conexDB.php';
use MonoApp\Models\Drivers\ConexDB;

$mensaje = "";
$redirect = "../mesas.php";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Primero borramos pedidos relacionados (order_details y orders)
    $db = new ConexDB();
    $db->exeSQL("DELETE FROM order_details WHERE idOrder IN (SELECT id FROM orders WHERE idTable = $id)");
    $db->exeSQL("DELETE FROM orders WHERE idTable = $id");

    // Ahora sí eliminamos la mesa
    $mesa = new Mesa();
    $mesa->delete($id);

    $mensaje = "Mesa eliminada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminando...</title>
    <meta http-equiv="refresh" content="2;url=<?= $redirect ?>">
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <h2><?= $mensaje ?></h2>
    <p>Redirigiendo en 2 segundos...</p>
</body>
</html>
