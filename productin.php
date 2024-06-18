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

    <script>
        // Add event listener to the form
        document.querySelector('form').addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Get the form data
            var formData = new FormData(this);

            // Send the form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'productin.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Form submitted successfully!');
                    window.location.href = 'productin.php';
                } else {
                    console.log('Error submitting form!');
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>