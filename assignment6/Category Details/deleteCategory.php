<?php
// Create connectionss
$conn = new mysqli("localhost", "root", "root", "mystore_db");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['categoryname'])) {
    $categoryname = $_GET['categoryname'];
    $sql = "DELETE FROM categories WHERE categoryname='$categoryname'";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayCategory.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
