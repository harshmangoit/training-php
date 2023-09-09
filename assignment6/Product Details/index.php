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
    include '../dbConnection.php';

    $productname = $identifier = $productid = '';

    $sql = "SELECT categoryname FROM categories";
    $result = $conn->query($sql);

    // Get Data for Editing
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['productid'])) {
        $productid = $_GET['productid'];
        $sql = "SELECT * FROM products WHERE productid='$productid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $productname = $row['productname'];
        $identifier = $row['identifier'];
        $category = $row['category'];
        $categoryArray = explode(',', $category);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["productid"]) && isset($_POST["productname"]) && isset($_POST["identifier"])) {

            $productid = $_POST["productid"];
            $productname = $_POST["productname"];

            // Product name validation
            if (empty($productname)) {
                $nameErr = " * Please Enter Product Name";
            } else {
                $nameErr = '';
            }

            if (empty($_POST["identifier"])) {
                $identifier = str_replace(' ', '-', strtolower($productname));
            } else {
                $identifier = $_POST["identifier"];
            }

            if (isset($_POST["category"])) {
                $category = $_POST['category'];
                $categoryArr = implode(", ", $category);
            }

            if ($productname && $categoryArr) {

                if ($productid == 0) {
                    $sql = "INSERT INTO products (productname, identifier, category) VALUES ('$productname', '$identifier', '$categoryArr')";
                } else {
                    $sql = "UPDATE products SET productname='$productname', identifier='$identifier', category='$categoryArr' WHERE productid='$productid'";
                }
                if ($conn->query($sql) === TRUE) {
                    header("Location: displayProduct.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    $conn->close();
    ?>
    <div class="form-container">
        <h3>Product Details:</h3><br>

        <form action="index.php" method="post">
            <input type="hidden" name="productid" value="<?php echo $productid; ?>">
            <div class="form-input">
                <label for="productname">Product Name:</label>
                <input type="text" id="productname" name="productname" value="<?php echo $productname;
                                                                                ?>" placeholder=" Enter Product Name">
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

            <div class="form-input">
                <label for="category">Category:</label>
                <select name="category[]" id="category" multiple>

                    <?php while ($row = $result->fetch_assoc()) {
                        $categoryid = $row['categoryid'];
                        $categoryname = $row['categoryname'];
                        $selected = (in_array($categoryid, $categoryArray)) ? 'selected' : '';
                        echo "<option value='$categoryname' $selected>$categoryname</option>";
                    ?>
                        <!-- <option value="<?php //echo $row['categoryname']; 
                                            ?>"><?php //echo $row['categoryname']; 
                                                ?></option> -->
                    <?php } ?>

                </select>
            </div><br>

            <div class=buttons>
                <div class="submit-button">
                    <button type="submit">Save</button>
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
