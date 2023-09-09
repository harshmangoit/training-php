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
    include '../dbConnection.php';

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <div class="table-container">
            <table>
                <h3>Product Details:</h3><br>
                <thead>
                    <th>Product name</th>
                    <th>Identifier</th>
                    <th>Category</th>
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
                            <?php echo $row["category"]; ?>
                        </td>
                        <td>
                            <?php echo "<a href='index.php?productid=" . $row['productid'] . "'>Edit</a>"; ?> |
                            <?php echo "<a href='deleteProduct.php?productid=" . $row['productid'] . "'>Delete</a>"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table><br>
            <div style="text-align: center;"><a href="index.php">Back</a></div>
        </div>
    <?php
    } else { ?>
        <div class='table-container'>
            <h3>Product Details are empty</h3>
            <div style="text-align: center;"><a href="index.php">Back</a></div>
        </div>
    <?php }
    $conn->close();
    ?>
</body>

</html>
