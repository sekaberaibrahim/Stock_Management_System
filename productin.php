<?php
require_once 'functions.php';

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];
    $prin_total_price = $prin_quantity * $prin_unit_price;

    $sql = "INSERT INTO Productin (ProductCode, prin_Date, prin_Quantity, prin_Unit_Price, prin_TotalPrice) VALUES ('$product_code', '$prin_date', '$prin_quantity', '$prin_unit_price', '$prin_total_price')";
    $conn->query($sql);
    header("Location: productin.php");
    exit();
}

$products = $conn->query("SELECT * FROM Products");
$productin_data = $conn->query("SELECT * FROM Productin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Record Product In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"], input[type="number"] {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        select {
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
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #3e8e41;
        }
        a {
            text-decoration: none;
            color: #337ab7;
        }
        a:hover {
            color: #23527c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #337ab7;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .action-btn {
            background-color: #337ab7;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #23527c;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <h2>Record Product In</h2>
    <form method="POST" action="productin.php">
        <label for="product_code">Product:</label>
        <select id="product_code" name="product_code">
            <?php while ($product = $products->fetch_assoc()) {?>
            <option value="<?php echo $product['ProductCode'];?>"><?php echo $product['ProductName'];?></option>
            <?php }?>
        </select>
        <br>
        <label for="prin_date">Date:</label>
        <input type="date" id="prin_date" name="prin_date" required>
        <br>
        <label for="prin_quantity">Quantity:</label>
        <input type="number" id="prin_quantity" name="prin_quantity" required>
        <br>
        <label for="prin_unit_price">Unit Price:</label>
        <input type="number" step="0.01" id="prin_unit_price" name="prin_unit_price" required>
        <br>
        <button type="submit">Submit</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>

    <h2>Product In Records</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Product Code</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $productin_data->fetch_assoc()) {?>
        <tr>
            <td><?php echo $row['prin_Date'];?></td>
            <td><?php echo $row['ProductCode'];?></td>
            <td><?php echo $row['prin_Quantity'];?></td>
            <td><?php echo $row['prin_Unit_Price'];?></td>
            <td><?php echo $row['prin_TotalPrice'];?></td>
            <td>
                <button class="action-btn">Update</button>
                <button class="delete-btn">Delete</button>
            </td>
        </tr>
        <?php }?>
    </table>

    <script>
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.parentNode.parentNode;
                var product_code = row.children[1].textContent;
                var prin_date = row.children[0].textContent;

                if (confirm('Are you sure you want to delete this record?')) {
                    window.location.href = 'delete_productin.php?product_code=' + product_code + '&prin_date=' + prin_date;
                }
            });
        });

        document.querySelectorAll('.action-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.parentNode.parentNode;
                var product_code = row.children[1].textContent;
                var prin_date = row.children[0].textContent;

                window.location.href = 'update_productin.php?product_code=' + product_code + '&prin_date=' + prin_date;
            });
        });
    </script>
</body>
</html>