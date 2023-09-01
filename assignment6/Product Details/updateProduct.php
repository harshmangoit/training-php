<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $oldproductname = $_POST["oldproductname"];
        $productname = $_POST["productname"];
        $identifier = $_POST['identifier'];
        // Product Name validation
        if (empty($oldproductname)) {
            $error1 = "* This field is required";
        } else {
            $error1 = '';
        }

        if (empty($productname)) {
            $error2 = "* This field is required";
        } else {
            $error2 = '';
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
        // 
        if ($productname && $oldproductname) {
            $sql = "UPDATE products SET productname='$productname', identifier='$identifier' WHERE productname='$oldproductname'";
            if ($conn->query($sql) === TRUE) {
                header("Location: displayProduct.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>

    <div class="form-container">
        <h3>Update Product Details:</h3><br>

        <form action="updateProduct.php" method="post">
            <div class="form-input">
                <label for="oldproductname">Old Product Name:</label>
                <input type="text" id="oldproductname" name="oldproductname" placeholder=" Enter Old Product Name">
            </div>
            <div>
                <div class="error">
                    <?php
                    if (isset($error1)) {
                        echo $error1;
                    }
                    ?>
                </div>
            </div>
            <br>
            <div class="form-input">
                <label for="productname">New Product Name:</label>
                <input type="text" id="productname" name="productname" placeholder=" Enter New Product Name">
            </div>
            <div>
                <div class="error">
                    <?php
                    if (isset($error2)) {
                        echo $error2;
                    }
                    ?>
                </div>
            </div>
            <br>

            <div class="form-input">
                <label for="identifier">New Identifier:</label>
                <input type="text" id="identifier" name="identifier" placeholder=" Enter Identifier">
            </div><br>

            <div class=buttons>
                <div class="submit-button">
                    <button type="submit">Update</button>
                </div>
            </div>
    </div>
    </form>
    </div>

</body>

</html>