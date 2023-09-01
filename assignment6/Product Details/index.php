<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $productname = $_POST["productname"];
        // Category name validation
        if (empty($productname)) {
            $error = "* This field is required";
        } else {
            $error = '';
        }

        if (empty($_POST["identifier"])) {
            $identifier = str_replace(' ', '-', strtolower($productname));
        } else {
            $identifier = $_POST["identifier"];
        }

        // Create connection
        $conn = new mysqli("localhost", "root", "root", "mystore_db");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($productname && $identifier) {
            // prepare, bind and execute
            $stmt = $conn->prepare("INSERT INTO products (productname, identifier) VALUES (?, ?)");
            $stmt->bind_param("ss", $productname, $identifier);
            $stmt->execute();

            $stmt->close();
        }
        $conn->close();
    }
    ?>

    <div class="form-container">
        <h3>Product Details:</h3><br>

        <form action="index.php" method="post">
            <div class="form-input">
                <label for="productname">Product Name:</label>
                <input type="text" id="productname" name="productname" placeholder=" Enter Product Name">
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
                    <a href="displayProduct.php">Show</a>
                </div>
            </div>
    </div>
    </form>
    </div>

</body>

</html>