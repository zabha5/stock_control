<?php
// Database connection
require_once('process/config.php'); // Connect to the database
require ('process/success.php');
require ('process/errors.php');
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($conn, $_POST['password_confirmation']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Check if passwords match
    if ($password !== $password_confirmation) {
        echo "<script>alert('Passwords do not match'); window.history.back();</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // Check if email already exist
    $checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'") or die (mysqli_error($conn));
    if (mysqli_num_rows($checkEmail) > 0) {
        $dataExist = "Your email";
        $redirection = "users.php";
        already_exist($dataExist,$redirection);
        
    } else{

    // Prepare execute query to insert the new user into the database
    $addUser = mysqli_query($conn, "INSERT INTO users (username, first_name, last_name, email, password, phone, role, status)
            VALUES ('$username', '$first_name', '$last_name', '$email', '$hashed_password', '$phone', '$role', '$status')") or die (mysqli_error($conn));

    if ($addUser == true) {
        echo "<script>alert('User created successfully'); window.location.href='users.php';</script>";
    } else {
        echo "<script>alert('Something Went Wromg!'); window.location.href='users.php';</script>";
    }
}
}

// Close the database connection
mysqli_close($conn);
?>
