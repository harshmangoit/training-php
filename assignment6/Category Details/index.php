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
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $categoryname = $_POST["categoryname"];
        // Category name validation
        if (empty($categoryname)) {
            $error = "* This field is required";
        } else {
            $error = '';
        }

        if (empty($_POST["identifier"])) {
            $identifier = str_replace(' ', '-', strtolower($categoryname));
        } else {
            $identifier = $_POST["identifier"];
        }

        // Create connection
        $conn = new mysqli("localhost", "root", "root", "mystore_db");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($categoryname && $identifier) {
            // prepare, bind and execute
            $stmt = $conn->prepare("INSERT INTO categories (categoryname, identifier) VALUES (?, ?)");
            $stmt->bind_param("ss", $categoryname, $identifier);
            $stmt->execute();

            $stmt->close();
        }
        $conn->close();
    }
    ?>

    <div class="form-container">
        <h3>Category Details:</h3><br>

        <form action="index.php" method="post">
            <div class="form-input">
                <label for="categoryname">Category Name:</label>
                <input type="text" id="categoryname" name="categoryname" placeholder=" Enter Category Name">
            </div>
            <div>
                <div class="error">
                    <?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?>
                </div>
            </div>
            <br>

            <div class="form-input">
                <label for="identifier">Identifier:</label>
                <input type="text" id="identifier" name="identifier" placeholder=" Enter Identifier">
            </div><br>

            <div class=buttons>
                <div class="submit-button">
                    <button type="submit">Add</button>
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