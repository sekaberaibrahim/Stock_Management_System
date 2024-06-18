<?php
require_once 'db.php';

if (isset($_GET['product_code']) && isset($_GET['prin_date'])) {
    $product_code = $_GET['product_code'];
    $prin_date = $_GET['prin_date'];

    $sql = "DELETE FROM Productin WHERE ProductCode = '$product_code' AND prin_Date = '$prin_date'";
    $conn->query($sql);

    header("Location: productin.php");
    exit();
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .delete-btn {
        background-color: #ff0000;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }
    .delete-btn:hover {
        background-color: #cc0000;
    }
</style>
<a href="delete_productin.php?product_code=<?php echo $product_code;?>&prin_date=<?php echo $prin_date;?>" class="delete-btn">Delete</a>