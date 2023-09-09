<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include '../dbConnection.php';

    $categoryname = $identifier = $categoryid = '';

    // Get Data for Editing
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['categoryid'])) {
        $categoryid = $_GET['categoryid'];
        $sql = "SELECT * FROM categories WHERE categoryid='$categoryid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $categoryname = $row['categoryname'];
        $identifier = $row['identifier'];
    }

    // Add Category
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["categoryid"]) && isset($_POST["categoryname"]) && isset($_POST["identifier"])) {

            $categoryid = $_POST["categoryid"];
            $categoryname = $_POST["categoryname"];

            // Category name validation
            if (empty($categoryname)) {
                $nameErr = " * Please Enter Category name";
            } else {
                $nameErr = '';
            }

            if (empty($_POST["identifier"])) {
                $identifier = str_replace(' ', '-', strtolower($categoryname));
            } else {
                $identifier = $_POST["identifier"];
            }

            if ($categoryname && $identifier) {
                if ($categoryid == 0) {
                    $sql = "INSERT INTO categories (categoryname, identifier) VALUES ('$categoryname', '$identifier')";
                } else {
                    $sql = "UPDATE categories SET categoryname='$categoryname', identifier='$identifier' WHERE categoryid='$categoryid'";
                }
                if ($conn->query($sql) === TRUE) {
                    header("Location: displayCategory.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
    ?>

    <div class="form-container">
        <h3>Category Details:</h3><br>

        <form action="index.php" method="post">
            <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>">
            <div class="form-input">
                <label for="categoryname">Category Name:</label>
                <input type="text" id="categoryname" name="categoryname" value="<?php echo $categoryname;
                                                                                ?>" placeholder=" Enter Category Name">
            </div>
            <div>
                <div class="error">
                    <?php
                    if (isset($nameErr)) {
                        echo $nameErr;
                    }
                    ?>
                </div>
            </div>
            <br>

            <div class="form-input">
                <label for="identifier">Identifier:</label>
                <input type="text" id="identifier" name="identifier" value="<?php echo $identifier;
                                                                            ?>" placeholder=" Enter Identifier">
            </div><br>

            <div class=buttons>
                <div class="submit-button">
                    <button type="submit">Save</button>
                </div>

                <div class="show-button">
                    <a href="displayCategory.php">Show</a>
                </div>
            </div>
    </div>
    </form>
    </div>

</body>

</html>
