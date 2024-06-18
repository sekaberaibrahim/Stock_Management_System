<?php
require_once 'db.php';

if (isset($_GET['product_code']) && isset($_GET['prin_date'])) {
    $product_code = $_GET['product_code'];
    $prin_date = $_GET['prin_date'];

    $sql = "SELECT * FROM Productin WHERE ProductCode = '$product_code' AND prin_Date = '$prin_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       ?>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            form {
                width: 50%;
                margin: 40px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            label {
                display: block;
                margin-bottom: 10px;
            }
            input[type="number"] {
                width: 100%;
                height: 40px;
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ccc;
            }
            button[type="submit"] {
                width: 100%;
                height: 40px;
                background-color: #4CAF50;
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
            }
            button[type="submit"]:hover {
                background-color: #3e8e41;
            }
        </style>
        <form method="POST" action="update_productin.php">
            <label for="prin_quantity">Quantity:</label>
            <input type="number" id="prin_quantity" name="prin_quantity" value="<?php echo $row['prin_Quantity'];?>" required>
            <br>
            <label for="prin_unit_price">Unit Price:</label>
            <input type="number" step="0.01" id="prin_unit_price" name="prin_unit_price" value="<?php echo $row['prin_Unit_Price'];?>" required>
            <br>
            <button type="submit">Update</button>
            <input type="hidden" name="product_code" value="<?php echo $product_code;?>">
            <input type="hidden" name="prin_date" value="<?php echo $prin_date;?>">
        </form>
        <?php
    } else {
        echo "Record not found";
    }
}

if (isset($_POST['prin_quantity']) && isset($_POST['prin_unit_price'])) {
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];

    $sql = "UPDATE Productin SET prin_Quantity = '$prin_quantity', prin_Unit_Price = '$prin_unit_price' WHERE ProductCode = '$product_code' AND prin_Date = '$prin_date'";
    $conn->query($sql);

    header("Location: productin.php");
    exit();
}
?>