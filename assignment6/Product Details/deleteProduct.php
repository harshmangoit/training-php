<?php
// Create connectionss
$conn = new mysqli("localhost", "root", "root", "mystore_db");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['productname'])) {
    $productname = $_GET['productname'];
    $sql = "DELETE FROM products WHERE productname='$productname'";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayProduct.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
