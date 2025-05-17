<?php
require_once '../../models/entities/order.php';
use App\models\entities\Order;

if (!isset($_POST['startDate']) || !isset($_POST['endDate'])) {
    header("Location: ../report_cancelled_form.php");
    exit;
}

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$orderModel = new Order();
$cancelledOrders = $orderModel->getCancelledOrders($startDate, $endDate);
$totalCancelled = $orderModel->getTotalCancelled($startDate, $endDate);

require_once '../cancelled_report.php';

