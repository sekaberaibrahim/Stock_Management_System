<?php
include 'db.php';

// Add Product Out
if (isset($_POST['add_product_out'])) {
  $ProductCode = $_POST['ProductCode'];
  $prout_Date = $_POST['prout_Date'];
  $prout_Quantity = $_POST['prout_Quantity'];
  $prout_unit_Price = $_POST['prout_unit_Price'];

  $prout_TotalPrice = $prout_Quantity * $prout_unit_Price;

  $query = "INSERT INTO ProductOut (ProductCode, prout_Date, prout_Quantity, prout_unit_Price, prout_TotalPrice) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssss", $ProductCode, $prout_Date, $prout_Quantity, $prout_unit_Price, $prout_TotalPrice);
  $stmt->execute();
  $stmt->close();

  header("Location: ". $_SERVER['PHP_SELF']);
}

// Update Product Out
if (isset($_POST['update_product_out'])) {
  $ProductOut_id = $_POST['id'];
  $ProductCode = $_POST['ProductCode'];
  $prout_Date = $_POST['prout_Date'];
  $prout_Quantity = $_POST['prout_Quantity'];
  $prout_unit_Price = $_POST['prout_unit_Price'];

  $prout_TotalPrice = $prout_Quantity * $prout_unit_Price;

  $query = "UPDATE ProductOut SET ProductCode =?, prout_Date =?, prout_Quantity =?, prout_unit_Price =?, prout_TotalPrice =? WHERE ProductOut_id =?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssssi", $ProductCode, $prout_Date, $prout_Quantity, $prout_unit_Price, $prout_TotalPrice, $ProductOut_id);
  $stmt->execute();
  $stmt->close();

  header("Location: ". $_SERVER['PHP_SELF']);
}

// Delete Product Out
if (isset($_GET['delete'])) {
  $ProductOut_id = $_GET['id'];

  $query = "DELETE FROM ProductOut WHERE ProductOut_id =?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $ProductOut_id);
  $stmt->execute();
  $stmt->close();

  header("Location: ". $_SERVER['PHP_SELF']);
}

// Retrieve all product outs
$query = "SELECT ProductOut_id, ProductCode, prout_Date, prout_Quantity, prout_unit_Price, prout_TotalPrice FROM ProductOut";
$result = $conn->query($query);

if (!$result) {
  echo "Error: ". $conn->error;
  exit();
}

?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
  }
 .container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
 .form-container {
    margin-bottom: 20px;
  }
 .form-container label {
    display: block;
    margin-bottom: 10px;
  }
 .form-container input[type="text"],.form-container input[type="date"],.form-container input[type="number"] {
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

<div class="container">
  <h2>Product Out Management</h2>
  <div class="form-container">
    <h2>Add New Product Out</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <label for="ProductCode">Product Code:</label>
      <input type="text" id="ProductCode" name="ProductCode" required>
      <br>
      <label for="prout_Date">Date:</label>
      <input type="date" id="prout_Date" name="prout_Date" required>
      <br>
      <label for="prout_Quantity">Quantity:</label>
      <input type="number" id="prout_Quantity" name="prout_Quantity" required>
      <br>
      <label for="prout_unit_Price">Unit Price:</label>
      <input type="number" id="prout_unit_Price" name="prout_unit_Price" required>
      <br>
      <button type="submit" name="add_product_out">Add Product Out</button>
    </form>
  </div>

  <table>
    <tr>
      <th>Product Code</th>
      <th>Date</th>
      <th>Quantity</th>
      <th>Unit Price</th>
      <th>Total Price</th>
      <th>Actions</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
      <tr>
        <td><?php echo $row["ProductCode"];?></td>
        <td><?php echo $row["prout_Date"];?></td>
        <td><?php echo $row["prout_Quantity"];?></td>
        <td><?php echo (isset($row["prout_unit_Price"]) &&!empty($row["prout_unit_Price"]))? $row["prout_unit_Price"] : '';?></td>
        <td><?php echo $row["prout_TotalPrice"];?></td>
        <td>
          <a href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row["ProductOut_id"];?>&update=true"><button class="action-btn">Update</button></a>
          <button class="delete-btn" onclick="if(confirm('Are you sure you want to delete this product out?')){location.href='<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row["ProductOut_id"];?>&delete=true'}">Delete</button>
        </td>
      </tr>
      
      <?php
    }
    ?>
  </table>

  <?php
  if (isset($_GET['update'])) {
    $ProductOut_id = $_GET['id'];

    $query = "SELECT ProductOut_id, ProductCode, prout_Date, prout_Quantity, prout_unit_Price, prout_TotalPrice FROM ProductOut WHERE ProductOut_id = '$ProductOut_id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

  ?>
    <div class="form-container">
      <h2>Update Product Out</h2>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="id" value="<?php echo $ProductOut_id;?>">
        <label for="ProductCode">Product Code:</label>
        <input type="text" id="ProductCode" name="ProductCode" value="<?php echo $row["ProductCode"];?>" required>
        <br>
        <label for="prout_Date">Date:</label>
        <input type="date" id="prout_Date" name="prout_Date" value="<?php echo $row["prout_Date"];?>" required>
        <br>
        <label for="prout_Quantity">Quantity:</label>
        <input type="number" id="prout_Quantity" name="prout_Quantity" value="<?php echo $row["prout_Quantity"];?>" required>
        <br>
        <label for="prout_unit_Price">Unit Price:</label>
        <input type="number" id="prout_unit_Price" name="prout_unit_Price" value="<?php echo (isset($row["prout_unit_Price"]) &&!empty($row["prout_unit_Price"]))? $row["prout_unit_Price"] : '';?>" required>
        <br>
        <button type="submit" name="update_product_out">Update Product Out</button>
      </form>
    </div>
    <?php
  }
  ?>

</div>

<footer class="footer">
  <a href="dashboard.php" style="font-size: 1.2em; color: #0000ff; text-decoration: none; margin-top: 20px; display: block; text-align: center;">Back to Dashboard</a>
  <p style="font-size: 0.8em; color: #666; margin-top:10px; text-align: center;">&copy; 2023 Copyright. All rights reserved.</p>
</footer>