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
    color: #D63535;
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
    background-color: #D63535;
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
  <h2>Users</h2>

  <?php
  $conn = mysqli_connect("localhost", "root", "", "STORE");
  if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
  }

  if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO Users (UserName, Password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>User created successfully!</p>";
  }

  if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE Users SET UserName = '$username', Password = '$password' WHERE UserId = '$id'";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>User updated successfully!</p>";
  }

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM Users WHERE UserId = '$id'";
    mysqli_query($conn, $query);
    echo "<p class='success-message'>User deleted successfully!</p>";
  }
?>

  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" name="create_user" value="Create User">
  </form>

  <table>
    <tr>
      <th>User ID</th>
      <th>Username</th>
      <th>Password</th>
      <th>Actions</th>
    </tr>
    <?php
    $query = "SELECT *FROM Users";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>". $row['UserId']. "</td>";
      echo "<td>". $row['UserName']. "</td>";
      echo "<td>". $row['Password']. "</td>";
      echo "<td><a href='".$_SERVER['PHP_SELF']."?id=". $row['UserId']. "&update=true'><button class='action-btn'>Update</button></a> | <button class='delete-btn' onclick=\"if(confirm('Are you sure you want to delete this user?')){location.href='".$_SERVER['PHP_SELF']."?id=". $row['UserId']. "&delete=true'}\">Delete</button></td>";
      echo "</tr>";
    }
?>
  </table>

  <?php
  if (isset($_GET['update'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM Users WHERE UserId = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

 ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo $row['UserName'];?>"><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" value="<?php echo $row['Password'];?>"><br><br>
      <input type="submit" name="update_user" value="Update User">
    </form>
    <?php
  }
?>

  <div class="footer" style="background-color: #f0f0f0; padding: 10px; text-align: center; color: #666;">
    <button class="back-btn" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="location.href='dashboard.php'">Back to Dashboard</button>
    <p style="color: #666;">&copy; 2024 💻 Ski Codes </></p>
  </div>
</div>