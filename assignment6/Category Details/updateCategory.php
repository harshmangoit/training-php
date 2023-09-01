<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>updateCategory</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $oldcategoryname = $_POST["oldcategoryname"];
        $categoryname = $_POST["categoryname"];
        $identifier = $_POST['identifier'];
        // Category name validation
        if (empty($oldcategoryname)) {
            $error1 = "* This field is required";
        } else {
            $error1 = '';
        }

        if (empty($categoryname)) {
            $error2 = "* This field is required";
        } else {
            $error2 = '';
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
        // 
        if ($categoryname && $oldcategoryname) {

            $sql = "UPDATE categories SET categoryname='$categoryname', identifier='$identifier' WHERE categoryname='$oldcategoryname'";
            if ($conn->query($sql) === TRUE) {
                header("Location: displayCategory.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>

    <div class="form-container">
        <h3>Update Category Details:</h3><br>

        <form action="updateCategory.php" method="post">
            <div class="form-input">
                <label for="oldcategoryname">Old Category Name:</label>
                <input type="text" id="oldcategoryname" name="oldcategoryname" placeholder=" Enter Old Category Name">
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
                <label for="categoryname">New Category Name:</label>
                <input type="text" id="categoryname" name="categoryname" placeholder=" Enter New Category Name">
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