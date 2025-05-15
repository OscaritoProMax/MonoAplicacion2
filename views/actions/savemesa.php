<?php
require_once '../../models/entities/mesa.php';
use App\models\Mesa;

$mesa = new Mesa();

if (!empty($_POST['nombre'])) {
    $mesa->set("nombre", $_POST['nombre']);

    if (!empty($_POST['id'])) {
        $mesa->set("id", $_POST['id']);
        $mesa->update();
    } else {
        $mesa->registrar();
    }
}

header("Location: ../mesas.php");
exit;
?>
