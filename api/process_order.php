<?php
include 'database.php';
session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $conn = new Database();
    if ($action == 'process') {
        $id = $_GET['id'];
        $status = 'processed';
        $sql = "UPDATE orders SET payment_status = '$status' WHERE id = $id";
        $result = $conn->query($sql);
        if ($result) {
            $query = "SELECT * FROM orders WHERE id = $id";
            $order = $conn->query($query)->fetch_assoc();
            $total = $order['total_price'];
            $sql = "INSERT INTO daily_sale (total) VALUES ($total)";
            $conn->query($sql);
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Order processed successfully';
        } else {
            $_SESSION['status'] = 'failed';
            $_SESSION['message'] = 'Failed to process order';
        }
        header('location: ../admin/index.php?layout=dashboard');
    }
    if ($action == 'delete') {
        $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE id = $id";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Order deleted successfully';
        } else {
            $_SESSION['status'] = 'failed';
            $_SESSION['message'] = 'Failed to delete order';
        }
        header('location: ../admin/index.php?layout=dashboard');
    }
}
