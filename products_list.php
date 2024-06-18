<?php

include('db.php');
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
    </style>
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

<style>
   .btn-edit,.btn-delete {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
   .btn-edit:hover,.btn-delete:hover {
        background-color: #3e8e41;
    }
   .btn-delete {
        background-color: #ff0000;
    }
   .btn-delete:hover {
        background-color: #cc0000;
    }
</style>