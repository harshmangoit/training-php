<?php
include '../dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid'];
    $sql = "DELETE FROM categories WHERE categoryid='$categoryid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: displayCategory.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
