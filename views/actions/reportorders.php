<?php
require_once '../../models/entities/order.php';
use App\models\entities\Order;

if (!isset($_POST['startDate']) || !isset($_POST['endDate'])) {
    header("Location: ../report_form.php");
    exit;
}

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$orderModel = new Order();
$orders = $orderModel->getOrdersByDateRange($startDate, $endDate);

require_once '../orders_report.php';
