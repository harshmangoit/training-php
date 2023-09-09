<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display category Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    include '../dbConnection.php';

    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <div class="table-container">
            <table>
                <h3>Category Details:</h3><br>
                <thead>
                    <th>Category name</th>
                    <th>Identifier</th>
                    <th>Action</th>
                </thead>
                <!-- output data of each row -->
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $row["categoryname"]; ?>
                        </td>
                        <td>
                            <?php echo $row["identifier"]; ?>
                        </td>
                        <td>
                            <?php echo "<a href='index.php?categoryid=" . $row['categoryid'] . "'>Edit</a>"; ?> |
                            <?php echo "<a href='deleteCategory.php?categoryid=" . $row['categoryid'] . "'>Delete</a>"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table><br>
            <div style="text-align: center;"><a href="index.php">Back</a></div>

        </div>

    <?php
    } else { ?>
        <div class='table-container'>
            <h3>Category Details are empty</h3>
            <div style="text-align: center;"><a href="index.php">Back</a></div>
        </div>
    <?php }
    $conn->close(); ?>
</body>

</html>
