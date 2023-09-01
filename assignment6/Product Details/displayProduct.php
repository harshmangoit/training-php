<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Product Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    // Create connectionss
    $conn = new mysqli("localhost", "root", "root", "mystore_db");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT productname, identifier FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <div class="table-container">
            <table>
                <h3>Product Details:</h3><br>
                <thead>
                    <th>Product name</th>
                    <th>Identifier</th>
                    <th>Action</th>
                </thead>
                <!-- output data of each row -->
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $row["productname"]; ?>
                        </td>
                        <td>
                            <?php echo $row["identifier"]; ?>
                        </td>
                        <td>
                            <?php echo "<a href='updateProduct.php'>Edit</a>"; ?> |
                            <?php echo "<a href='deleteProduct.php?productname=" . $row['productname'] . "'>Delete</a>"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php
    } else {
        echo "<div class='table-container'><h3>Product Details are empty</h3></div>";
    }
    $conn->close();
    ?>
</body>

</html>