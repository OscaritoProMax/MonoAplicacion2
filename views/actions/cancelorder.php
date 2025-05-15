<?php
$redirect = "../orders.php";
$mensaje = "";

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $filename = __DIR__ . '/anuladas.txt';
    $anuladas = [];

    if (file_exists($filename)) {
        $anuladas = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    if (!in_array((string)$id, $anuladas, true)) {
        file_put_contents($filename, $id . PHP_EOL, FILE_APPEND | LOCK_EX);
        $mensaje = "Orden anulada correctamente.";
    } else {
        $mensaje = "La orden ya está anulada.";
    }
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
