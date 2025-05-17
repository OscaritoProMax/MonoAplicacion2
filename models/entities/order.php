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

    $sql = "SELECT id, dateOrder, total, idTable 
            FROM orders 
            WHERE isCancelled = 0 
              AND dateOrder BETWEEN '$startDate' AND '$endDate' 
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

public function getTotalRecaudado($startDate, $endDate) {
    $sql = "SELECT SUM(total) AS total 
            FROM orders 
            WHERE isCancelled = 0 
              AND dateOrder BETWEEN '$startDate' AND '$endDate'";
    $res = $this->db->exeSQL($sql);
    $row = $res->fetch_assoc();
    return $row['total'] ?? 0;
}

public function getDishesRanking($startDate, $endDate) {
    $sql = "SELECT d.description AS plato, SUM(od.quantity) AS total_vendido
            FROM order_details od
            JOIN dishes d ON od.idDish = d.id
            JOIN orders o ON od.idOrder = o.id
            WHERE o.isCancelled = 0
              AND o.dateOrder BETWEEN '$startDate' AND '$endDate'
            GROUP BY od.idDish
            ORDER BY total_vendido DESC";
    return $this->db->exeSQL($sql);
}

public function getCancelledOrders($startDate, $endDate) {
    $sql = "SELECT id, dateOrder, total FROM orders 
            WHERE isCancelled = 1 
            AND dateOrder BETWEEN '$startDate' AND '$endDate'";
    return $this->db->exeSQL($sql);
}

public function getTotalCancelled($startDate, $endDate) {
    $sql = "SELECT SUM(total) as total FROM orders 
            WHERE isCancelled = 1 
            AND dateOrder BETWEEN '$startDate' AND '$endDate'";
    $result = $this->db->exeSQL($sql);
    $row = $result->fetch_assoc(); // Asegúrate que exeSQL devuelva mysqli_result
    return $row['total'] ?? 0;
}



}
