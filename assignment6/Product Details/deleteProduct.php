<?php
include '../dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $sql = "DELETE FROM products WHERE productid='$productid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayProduct.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
