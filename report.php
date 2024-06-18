<?php
require_once 'functions.php';
require_once 'db.php';

$products_in = $conn->query("SELECT * FROM Productin WHERE prin_Date = CURDATE()");
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
    </style>
</head>
<body>
    <h2>Daily Stock Status Report</h2>
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
            <?php while ($product = $products_in->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($product['ProductCode']); ?></td>
                <td><?php echo htmlspecialchars($product['prin_Date']); ?></td>
                <td><?php echo htmlspecialchars($product['prin_Quantity']); ?></td>
                <td><?php echo htmlspecialchars($product['prin_Unit_Price']); ?></td>
                <td><?php echo htmlspecialchars($product['prin_TotalPrice']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>

    <script>
        // Optional JavaScript for functionality enhancements sorting table rows by clicking on headers
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('table th');
            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const index = header.cellIndex;
                    const rows = Array.from(document.querySelectorAll('table tbody tr'));
                    rows.sort((a, b) => {
                        const cellA = a.cells[index].textContent.trim();
                        const cellB = b.cells[index].textContent.trim();
                        return isNaN(cellA) ? cellA.localeCompare(cellB) : parseFloat(cellA) - parseFloat(cellB);
                    });
                    rows.forEach(row => row.parentNode.appendChild(row)); // Re-append sorted rows
                });
            });
        });
    </script>
</body>
</html>
