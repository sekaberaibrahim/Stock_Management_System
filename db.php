<?php

$conn = new mysqli("localhost", "root", "", "store");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>