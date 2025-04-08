<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "stock_control";

$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if(isset($_POST['create_supplier'])){
    $supplier_name = $_POST['supplier_name'];
    $supplier_contact = $_POST['contact'];
    $status = $_POST['status'];
    $sql = mysqli_query($conn,"INSERT INTO suppliers (supplier_name, contact, status) VALUES ('$supplier_name','$supplier_contact','$status')");
    if($sql){
        header('location:supplier.php');
 }else{
    $error1="Not inserted";
 }
}

?>
