<style>
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
  }
  input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #3e8e41;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
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
 .success-message {
    color: green;
    margin-top: 10px;
    text-align: center;
  }
 .error-message {
    color: red;
    margin-top: 10px;
    text-align: center;
  }
 .back-btn {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
 .back-btn:hover {
    background-color: #3e8e41;
  }
 .footer {
    background-color: #f0f0f0;
    padding: 10px;
    text-align: center;
    color: #666;
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
</style>

<div class="container">
  <h2>Productin</h2>

  <?php
  $conn = mysqli_connect("localhost", "root", "", "STORE");
  if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
  }

  if (isset($_POST['create_productin'])) {
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];

    $query = "INSERT INTO Productin (ProductCode, prin_Date, prin_Quantity, prin_Unit_Price) VALUES ('$product_code', '$prin_date', '$prin_quantity', '$prin_unit_price')";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>Productin created successfully!</p>";
  }

  if (isset($_POST['update_productin'])) {
    $id = $_POST['id'];
    $product_code = $_POST['product_code'];
    $prin_date = $_POST['prin_date'];
    $prin_quantity = $_POST['prin_quantity'];
    $prin_unit_price = $_POST['prin_unit_price'];

    $query = "UPDATE Productin SET ProductCode = '$product_code', prin_Date = '$prin_date', prin_Quantity = '$prin_quantity', prin_Unit_Price = '$prin_unit_price' WHERE Productin_id = '$id'";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>Productin updated successfully!</p>";
  }

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM Productin WHERE Productin_id = '$id'";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>Productin deleted successfully!</p>";
  }
 ?>

  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
   <label for="product_code">Product Code:</label>
    <select id="product_code" name="product_code">
      <?php
      $query = "SELECT * FROM Products";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='". $row['ProductCode']. "'>". $row['ProductName']. " (". $row['ProductCode']. ")</option>";
      }
    ?>
    </select><br><br>
    <label for="prin_date">Prin Date:</label>
    <input type="date" id="prin_date" name="prin_date"><br><br>
    <label for="prin_quantity">Prin Quantity:</label>
    <input type="number" id="prin_quantity" name="prin_quantity"><br><br>
    <label for="prin_unit_price">Prin Unit Price:</label>
    <input type="number" step="0.01" id="prin_unit_price" name="prin_unit_price"><br><br>
    <input type="submit" name="create_productin" value="Create Productin">
  </form>

  <table>
    <tr>
      <th>Productin ID</th>
      <th>Product Code</th>
      <th>Product Name</th>
      <th>Prin Date</th>
      <th>Prin Quantity</th>
      <th>Prin Unit Price</th>
      <th>Prin Total Price</th>
      <th>Actions</th>
    </tr>
    <?php
    $query = "SELECT p.Productin_id, p.ProductCode, pr.ProductName, p.prin_Date, p.prin_Quantity, p.prin_Unit_Price, p.prin_TotalPrice
             FROM Productin p
             JOIN Products pr ON p.ProductCode = pr.ProductCode";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>". $row['Productin_id']. "</td>";
      echo "<td>". $row['ProductCode']. "</td>";
      echo "<td>". $row['ProductName']. "</td>";
      echo "<td>". $row['prin_Date']. "</td>";
      echo "<td>". $row['prin_Quantity']. "</td>";
      echo "<td>". $row['prin_Unit_Price']. "</td>";
      echo "<td>". $row['prin_TotalPrice']. "</td>";
      echo "<td><a href='".$_SERVER['PHP_SELF']."?id=". $row['Productin_id']. "&update=true'><button class='action-btn'>Update</button></a> | <button class='delete-btn' onclick=\"if(confirm('Are you sure you want to delete this productin?')){location.href='".$_SERVER['PHP_SELF']."?id=". $row['Productin_id']. "&delete=true'}\">Delete</button></td>";
      echo "</tr>";
    }
  ?>
  </table>

  <?php
  if (isset($_GET['update'])) {
    $id = $_GET['id'];

    $query = "SELECT p.Productin_id, p.ProductCode, pr.ProductName, p.prin_Date, p.prin_Quantity, p.prin_Unit_Price
             FROM Productin p
             JOIN Products pr ON p.ProductCode = pr.ProductCode
             WHERE p.Productin_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <label for="product_code">Product Code:</label>
      <select id="product_code" name="product_code">
        <?php
        $query = "SELECT * FROM Products";
        $result = mysqli_query($conn, $query);
        while ($row_product = mysqli_fetch_assoc($result)) {
          if ($row_product['ProductCode'] == $row['ProductCode']) {
            echo "<option value='". $row_product['ProductCode']. "' selected>". $row_product['ProductName']. " (". $row_product['ProductCode']. ")</option>";
          } else {
            echo "<option value='". $row_product['ProductCode']. "'>". $row_product['ProductName']. " (". $row_product['ProductCode']. ")</option>";
          }
        }
      ?>
      </select><br><br>
      <label for="prin_date">Prin Date:</label>
      <input type="date" id="prin_date" name="prin_date" value="<?php echo $row['prin_Date'];?>"><br><br>
      <label for="prin_quantity">Prin Quantity:</label>
      <input type="number" id="prin_quantity" name="prin_quantity" value="<?php echo $row['prin_Quantity'];?>"><br><br>
      <label for="prin_unit_price">Prin Unit Price:</label>
      <input type="number" step="0.01" id="prin_unit_price" name="prin_unit_price" value="<?php echo $row['prin_Unit_Price'];?>"><br><br>
      <input type="submit" name="update_productin" value="Update Productin">
    </form>
    <?php
  }
?>

<div class="footer" style="background-color: #f0f0f0; padding: 10px; text-align: center; color: #666;">
    <button class="back-btn" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="location.href='dashboard.php'">Back to Dashboard</button>
    <p style="color: #666;">&copy; 2024 💻 Ski Codes </></p>
  </div>
</div>