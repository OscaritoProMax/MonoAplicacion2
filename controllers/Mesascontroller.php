<?php
// Archivo: controllers/MesaController.php

use App\models\Mesa;

require_once 'models/mesa.php';

class MesaController {
    public function index() {
        $mesa = new Mesa();
        $mesas = $mesa->all();
        require_once 'views/mesas.php';
    }

    public function save() {
        if (isset($_POST['nombre'])) {
            $mesa = new Mesa();
            $mesa->set("nombre", $_POST['nombre']);
            $mesa->registrar();
        }
        header("Location: index.php?controller=Mesa&action=index");
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $mesa = new Mesa();
            $mesa = $mesa->find($_GET['id']);
            require_once 'views/form_mesa.php';
        }
    }

    public function update() {
        if (isset($_POST['id']) && isset($_POST['nombre'])) {
            $mesa = new Mesa();
            $mesa->set("id", $_POST['id']);
            $mesa->set("nombre", $_POST['nombre']);
            $mesa->update();
        }
        header("Location: index.php?controller=Mesa&action=index");
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $mesa = new Mesa();
            if ($mesa->canDelete($_GET['id'])) {
                $mesa->delete($_GET['id']);
            }
        }
        header("Location: index.php?controller=Mesa&action=index");
    }
}
