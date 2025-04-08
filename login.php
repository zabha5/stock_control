<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stock_control");
     
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $user =  $_POST['name'];
    $pwd =  $_POST['password'];
    $sql = mysqli_query($conn, "SELECT * FROM admins WHERE name = '$user' AND password = '$pwd'");
    $row = mysqli_fetch_array($sql);

    if ($row) {
        $_SESSION['admin_id'] = $row['admin_id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-[#1abc9c]">Admin Login</h2>
        
        <?php if (isset($error)) { ?>
            <div class="bg-red-500 text-white text-center p-2 rounded mb-4"><?php echo $error; ?></div>
        <?php } ?>
        
        <form action="" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="name" id="username" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
            </div>

            <div class="flex justify-center">
                <button type="submit"name="login" class="bg-[#1abc9c] text-white py-2 px-4 rounded hover:bg-teal-600">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
