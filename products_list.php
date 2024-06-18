<?php

include('db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];

 
    $stmt = $conn->prepare("INSERT INTO Products (ProductCode, ProductName) VALUES (?, ?)");
    $stmt->bind_param("ss", $product_code, $product_name);


    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: products_list.php");
    exit();
}

$query = "SELECT * FROM Products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 40px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ccc;
        }
       .form-container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       .form-container label {
            display: block;
            margin-bottom: 10px;
        }
       .form-container input[type="text"] {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
       .form-container button[type="submit"] {
            width: 100%;
            height: 40px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .form-container button[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
    <div class="form-container">
        <h2>Add New Product</h2>
        <form method="POST" action="products_list.php">
          <!--<label for="product_code">Product Code:</label>
            <input type="text" id="product_code" name="product_code" required>
            <br>  -->
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <br>
            <button type="submit">Add Product</button>
        </form>
    </div>
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
                <td><?php echo $row["ProductCode"];?></td>
                <td><?php echo $row["ProductName"];?></td>
            </tr>
            
            <?php
        }
      ?>
    </table>
    
    <?php
} else {
    echo "No products found";
}
?>
    <footer>
    <a href="dashboard.php" style="font-size: 1.2em; color: #0000ff; text-decoration: none; margin-top: 20px; display: block; text-align: center;">Back to Dashboard</a>
            </footer>