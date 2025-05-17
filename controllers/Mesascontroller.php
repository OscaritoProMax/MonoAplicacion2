<?php 


use App\models\Mesa;

require_once 'models/mesa.php';

class MesaController {

    public function index() {
        $mesa = new Mesa();
        $mesas = $mesa->all();
        require_once 'views/mesas.php';
    }

   
    public function new() {
        $mesa = new Mesa(); 
        require_once 'views/form_mesa.php';
    }

    public function save() {
        if (isset($_POST['name'])) {
            $mesa = new Mesa();
            $mesa->set("name", $_POST['name']);
            $mesa->registrar();
        }
        header("Location: index.php?controller=Mesa&action=index");
        exit;
    }

    public function edit() {
        $mesaModel = new Mesa();

        if (isset($_GET['id'])) {
            $mesa = $mesaModel->find($_GET['id']);
            if (!$mesa) {
                header("Location: index.php?controller=Mesa&action=index");
                exit;
            }
        } else {
            $mesa = new Mesa(); 
        }

        require_once 'views/form_mesa.php';
    }

    public function update() {
        if (isset($_POST['id']) && isset($_POST['name'])) {
            $mesa = new Mesa();
            $mesa->set("id", $_POST['id']);
            $mesa->set("name", $_POST['name']);
            $mesa->update();
        }
        header("Location: index.php?controller=Mesa&action=index");
        exit;
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $mesa = new Mesa();
            $id = $_GET['id'];
            if ($mesa->canDelete($id)) {
                $mesa->delete($id);
            }
        }
        header("Location: index.php?controller=Mesa&action=index");
        exit;
    }
}
