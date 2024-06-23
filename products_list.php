<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];

        $stmt = $conn->prepare("INSERT INTO Products (ProductCode, ProductName) VALUES (?,?)");
        $stmt->bind_param("ss", $product_code, $product_name);

        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: products_list.php");
        exit();
    } elseif (isset($_POST['update_product'])) {
        $id = $_POST['id'];
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];

        $stmt = $conn->prepare("UPDATE Products SET ProductCode =?, ProductName =? WHERE ProductCode =?");
        $stmt->bind_param("ssi", $product_code, $product_name, $id);

        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: products_list.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM Products WHERE ProductCode =?");
    $stmt->bind_param("s", $id);

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
       .action-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .action-btn:hover {
            background-color: #3e8e41;
        }
       .delete-btn {
            background-color: #FF0000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .delete-btn:hover {
            background-color: #CC0000;
        }
       .footer {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            color: #666;
        }
    </style>
    <div class="form-container">
        <h2>Add New Product</h2>
        <form method="POST" action="products_list.php">
            
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <br>
            <button type="submit"name="add_product">Add Product</button>
        </form>
    </div>
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["ProductCode"];?></td>
                <td><?php echo $row["ProductName"];?></td>
                <td>
                    <a href="products_list.php?id=<?php echo $row["ProductCode"];?>&update=true"><button class="action-btn">Update</button></a>
                    <button class="delete-btn" onclick="if(confirm('Are you sure you want to delete this product?')){location.href='products_list.php?id=<?php echo $row["ProductCode"];?>&delete=true'}">Delete</button>
                </td>
            </tr>
            
            <?php
        }
     ?>
    </table>
    
    <?php
    if (isset($_GET['update'])) {
        $id = $_GET['id'];

        $query = "SELECT ProductCode, ProductName FROM Products WHERE ProductCode = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();

     ?>
        <div class="form-container">
            <h2>Update Product</h2>
            <form method="POST" action="products_list.php">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <label for="product_code">Product Code:</label>
                <input type="text" id="product_code" name="product_code" value="<?php echo $row["ProductCode"];?>" required>
                <br>
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo $row["ProductName"];?>" required>
                <br>
                <button type="submit" name="update_product">Update Product</button>
            </form>
        </div>
        <?php
    }
} else {
    echo "No products found";
}
?>

<div class="footer" style="background-color: #f0f0f0; padding: 10px; text-align: center; color: #666;">
    <button class="back-btn" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="location.href='dashboard.php'">Back to Dashboard</button>
    <p style="color: #666;">&copy; 2024 💻 Ski Codes </></p>
  </div>
</div>