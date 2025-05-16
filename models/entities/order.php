<?php
namespace App\models\entities;

use MonoApp\Models\Drivers\ConexDB;

require_once __DIR__ . '/../drivers/conexDB.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = new ConexDB();
    }

    public function getOrdersByDateRange($startDate, $endDate) {
        $orders = [];
        // Ya no se selecciona isCancelled porque no existe en la base de datos
        $sql = "SELECT id, dateOrder, total, idTable 
                FROM orders 
                WHERE dateOrder BETWEEN '$startDate' AND '$endDate' 
                ORDER BY dateOrder DESC";
        $res = $this->db->exeSQL($sql);
        while ($order = $res->fetch_assoc()) {
            $order['details'] = [];
            $orderId = $order['id'];

            $sqlDetails = "SELECT od.*, d.description 
                           FROM order_details od
                           JOIN dishes d ON d.id = od.idDish
                           WHERE idOrder = $orderId
                           ORDER BY (od.quantity * od.price) DESC";

            $resDetails = $this->db->exeSQL($sqlDetails);
            while ($detail = $resDetails->fetch_assoc()) {
                $order['details'][] = $detail;
            }

            $orders[] = $order;
        }
        return $orders;
    }
}
