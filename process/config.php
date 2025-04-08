<?php
$conn = mysqli_connect("localhost", "root", "", "stock_control");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>