<?php
include('db.php');
session_start();

if (!isset($_SESSION["username"])) {
  
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;600&family=Lobster&display=swap');
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            font-family: 'Lobster', cursive;
            font-size: 36px;
            color: #333333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .typewriter h2 {
            display: inline-block;
            overflow: hidden;
            border-right: .15em solid #333; 
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .15em;
            animation: typing 3.5s steps(30, end), blink-caret .75s step-end infinite;
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #333; }
        }
        p {
            font-size: 18px;
            color: #666666;
            font-family: 'Roboto', sans-serif;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #ffffff;
            background: linear-gradient(to right, #007bff, #00c6ff);
            padding: 10px 20px;
            border-radius: 5px;
            display: block;
            text-align: center;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            transition: background 0.3s ease;
        }
        a:hover {
            background: linear-gradient(to right, #0056b3, #0094cc);
        }
        .gradient-text {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            -webkit-background-clip: text;
            color: transparent;
            animation: gradient 3s infinite;
        }
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 10px;
            }
            a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .header svg {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2a10 10 0 00-7.07 17.07A10 10 0 1012 2zm1 14.59L8.41 12 7 13.41 12 18.41l7-7-1.41-1.41L13 16.59z"/>
            </svg>
            <h2 class="gradient-text">Dashboard</h2>
        </div>
        <div class="typewriter">
            <h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
        </div>
        <ul>
            <li><a href="products_list.php">Products</a></li>
            <li><a href="productin.php">Product In</a></li>
            <li><a href="">Product Out</a></li>
            <li><a href="report.php">Daily Stock Status</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="productin.php">Store Keeper </a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <script src="script.js"></script>
</body>
</html>
