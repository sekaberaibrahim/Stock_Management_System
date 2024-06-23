<?php
require_once 'functions.php';
require_once 'db.php';

if (isset($_POST['date'])) {
    $selected_date = $_POST['date'];
    $products_in = $conn->query("SELECT * FROM Productin WHERE prin_Date = '$selected_date'");
} else {
    $products_in = $conn->query("SELECT * FROM Productin WHERE prin_Date = CURDATE()");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Stock Status Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f0f0f0;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
       .report-form {
            margin: 20px auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       .report-form label {
            display: block;
            margin-bottom: 10px;
        }
       .report-form input[type="date"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
       .report-form button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       .report-form button[type="submit"]:hover {
            background-color: #3e8e41;
        }
       .download-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            text-align: center;
        }
       .download-button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h2>Daily Stock Status Report</h2>
    <div class="report-form">
        <form action="" method="post">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d');?>">
            <button type="submit">Generate Report</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $products_in->fetch_assoc()) {?>
            <tr>
                <td><?php echo htmlspecialchars($product['ProductCode']);?></td>
                <td><?php echo htmlspecialchars($product['prin_Date']);?></td>
                <td><?php echo htmlspecialchars($product['prin_Quantity']);?></td>
                <td><?php echo htmlspecialchars($product['prin_Unit_Price']);?></td>
                <td><?php echo htmlspecialchars($product['prin_TotalPrice']);?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <footer>
     
        <button class="download-button" onclick="downloadReport()">Download Report</button>
    </footer>
    <script>
        function downloadReport() {
            const table = document.querySelector('table');
            const rows = table.rows;
            const csvContent = [];
            for (let i = 0; i < rows.length; i++) {
                const row = [];
                for (let j = 0; j < rows[i].cells.length; j++) {
                    row.push(rows[i].cells[j].textContent.trim());
                }
                csvContent.push(row.join(','));
            }
            const csvBlob = new Blob([csvContent.join('\n')], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(csvBlob);
            link.download = 'daily_stock_status_report.csv';
            link.click();
        }
    </script>
</body>
</html>
<div class="footer" style="background-color: #f0f0f0; padding: 10px; text-align: center; color: #666;">
    <button class="back-btn" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="location.href='dashboard.php'">Back to Dashboard</button>
    <p style="color: #666;">&copy; 2024 💻 Ski Codes </></p>
  </div>
</div>