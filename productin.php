<?php
session_start();
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add Productin
if (isset($_POST['add'])) {
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];
    $prin_total_price = $prin_quantity * $prin_unit_price;

    $sql = "INSERT INTO Productin (ProductCode, prin_Date, prin_Quantity, prin_Unit_Price, prin_TotalPrice) 
            VALUES ('$product_code', '$prin_date', '$prin_quantity', '$prin_unit_price', '$prin_total_price')";
    $conn->query($sql);
}

// Update Productin
if (isset($_POST['update'])) {
    $productin_id = $_POST['productin_id'];
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];
    $prin_total_price = $prin_quantity * $prin_unit_price;

    $sql = "UPDATE Productin 
            SET ProductCode='$product_code', prin_Date='$prin_date', prin_Quantity='$prin_quantity', prin_Unit_Price='$prin_unit_price', prin_TotalPrice='$prin_total_price' 
            WHERE Productin_id='$productin_id'";
    $conn->query($sql);
}

// Delete Productin
if (isset($_GET['delete'])) {
    $productin_id = $_GET['delete'];
    $sql = "DELETE FROM Productin WHERE Productin_id='$productin_id'";
    $conn->query($sql);
}

// Retrieve Productin records
$sql = "SELECT * FROM Productin";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product In Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            color: #4CAF50;
            font-weight: bold;
        }
        input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #4CAF50;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions button, .actions a {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
        }
        .actions a {
            text-decoration: none;
            color: #fff;
            background-color: red;
        }
        .actions a:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product In Management</h2>

        <!-- Add Productin Form -->
        <form method="POST" action="productin.php">
            <input type="hidden" name="productin_id" id="productin_id">
            <label for="product_code">Product Code:</label>
            <input type="number" name="product_code" id="product_code" required>
            <label for="prin_date">Date:</label>
            <input type="date" name="prin_date" id="prin_date" required>
            <label for="prin_quantity">Quantity:</label>
            <input type="number" name="prin_quantity" id="prin_quantity" required>
            <label for="prin_unit_price">Unit Price:</label>
            <input type="number" step="0.01" name="prin_unit_price" id="prin_unit_price" required>
            <button type="submit" name="add" id="add_button">Add Productin</button>
            <button type="submit" name="update" id="update_button" style="display: none;">Update Productin</button>
        </form>

        <!-- Display Productin Records -->
        <table>
            <thead>
                <tr>
                    <th>Productin ID</th>
                    <th>Product Code</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['Productin_id']; ?></td>
                        <td><?php echo $row['ProductCode']; ?></td>
                        <td><?php echo $row['prin_Date']; ?></td>
                        <td><?php echo $row['prin_Quantity']; ?></td>
                        <td><?php echo $row['prin_Unit_Price']; ?></td>
                        <td><?php echo $row['prin_TotalPrice']; ?></td>
                        <td class="actions">
                            <button onclick="editProductin(<?php echo $row['Productin_id']; ?>, <?php echo $row['ProductCode']; ?>, '<?php echo $row['prin_Date']; ?>', <?php echo $row['prin_Quantity']; ?>, <?php echo $row['prin_Unit_Price']; ?>)">Edit</button>
                            <a href="productin.php?delete=<?php echo $row['Productin_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="dashboard.php">Back to Dashboard</a>
    </div>

    <script>
        function editProductin(productin_id, product_code, prin_date, prin_quantity, prin_unit_price) {
            document.getElementById('productin_id').value = productin_id;
            document.getElementById('product_code').value = product_code;
            document.getElementById('prin_date').value = prin_date;
            document.getElementById('prin_quantity').value = prin_quantity;
            document.getElementById('prin_unit_price').value = prin_unit_price;
            document.getElementById('add_button').style.display = 'none';
            document.getElementById('update_button').style.display = 'inline';
        }
    </script>
</body>
</html>
