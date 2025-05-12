<?php
require_once("models/entities/mesa.php");

class Mesascontroller {
    public function index() {
        $mesas = Mesa::getAll();
        include("views/mesas.php");
    }

    public function form($id = null) {
        $mesa = null;
        if ($id) {
            $mesa = Mesa::getById($id);
        }
        include("views/form_mesa.php");
    }
}
?>
