<?php
require_once 'models/order.php';

class OrderController {

    public function index() {
        $orderModel = new Order();
        $orders = $orderModel->getAllWithDetails();
        require_once 'views/orders.php';
    }

    public function cancel() {
        if (isset($_GET['id'])) {
            $orderModel = new Order();
            $orderModel->cancelOrder($_GET['id']);
        }
        header("Location: index.php?controller=Order&action=index");
        exit;
    }

    public function reportForm() {
        require_once 'views/report_form.php';
    }

    public function generateReport() {
        if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $orderModel = new Order();
            $orders = $orderModel->getOrdersByDateRange($startDate, $endDate);

            require_once 'views/orders_report.php';
        } else {
            header("Location: index.php?controller=Order&action=reportForm");
            exit;
        }
    }
}
