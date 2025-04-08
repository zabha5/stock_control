<?php

require_once('process/config.php'); // Connect to the database

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Returns</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
        }
        .main-header {
            background-color: #1abc9c;
        }
        .sidebar {
            background-color: #ffffff;
        }
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .sidebar a {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease;
            background-color: #e0f7f4;
        }
        .sidebar a:hover {
            background-color:rgb(160, 245, 234);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 50;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
        }

    </style>
</head>

<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 sidebar h-screen shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-[#1abc9c]">Stock System</h1>
        <ul>
            <li class="mb-4 font-bold "><a href="dashboard.php" class="ml-4">Dashboard</a></li>
            <li class="mb-4 font-bold "><a href="product.php" class="ml-4">Products</a></li>
            <li class="mb-4 font-bold "><a href="stock_out.php" class="ml-4">Stock Out</a></li>
            <li class="mb-4 font-bold "><a href="sales.php" class="ml-4">Sales</a></li>
            <li class="mb-4 font-bold "><a href="returns.php" class="ml-4">Returns</a></li>
            <li class="mb-4 font-bold "><a href="#" class="ml-4 text-[#1abc9c] text-sm">Users</a></li>
            <li class="mb-4 font-bold "><a href="supplier.php" class="ml-4">Supplier</a></li>
            <li class="mb-4 font-bold "><a href="#" class="ml-4">Reports</a></li>
        </ul>
    </div>

    <!-- Main content -->

<div class="flex-1 p-6">
    <h1 class="text-2xl font-bold mb-6">Users</h1>

    <!-- User Listing Table -->
    <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b font-medium">
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">First Name</th>
                    <th class="px-6 py-3">last Name</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Date Registered</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through users and display them -->
                <?php
                // Assuming connection is established
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "
                            <tr class='border-b'>
                                <td class='px-6 py-4'>{$row['username']}</td>
                                <td class='px-6 py-4'>{$row['first_name']}</td>
                                <td class='px-6 py-4'>{$row['last_name']}</td>
                                <td class='px-6 py-4'>{$row['role']}</td>
                                <td class='px-6 py-4'>{$row['status']}</td>
                                <td class='px-6 py-4'>{$row['created_at']}</td>
                                <td class='px-6 py-4'>
                                    <button class='bg-yellow-500 text-white px-4 py-1 rounded'>Edit</button>
                                    <button class='bg-red-500 text-white px-4 py-1 rounded'>Delete</button>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6' class='px-6 py-4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add New User Button (opens modal) -->
    <button class="bg-teal-500 text-white px-6 py-2 rounded-lg mt-6" id="addUserBtn">Add New User</button>

  <!-- Add New User Modal -->
<div id="addUserModal" class="modal fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg relative w-96">
        <span class="close-btn text-xl absolute top-2 right-2 cursor-pointer" id="closeAddUserModal">&times;</span>
        <h3 class="text-2xl font-semibold mb-4">Create New User</h3>
        <form action="create_user.php" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="text" name="first_name" placeholder="First Name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="text" name="last_name" placeholder="last Name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            <input type="password" name="phone" placeholder="Phone number" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
            
            <select name="role" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>

            <select name="status" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit" class="w-full bg-teal-500 text-white py-2 rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">Create User</button>
        </form>
    </div>
</div>

<!-- Tailwind CSS for Modal Display -->
<script>
    const openModalBtn = document.getElementById('addUserBtn');
    const modal = document.getElementById('addUserModal');
    const closeModalBtn = document.getElementById('closeAddUserModal');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>

</div>

<script>
   
    document.getElementById('addUserBtn').addEventListener('click', function () {
            document.getElementById('addUserModal').style.display = 'flex';
        });

        document.getElementById('closeAddUserModal').addEventListener('click', function () {
            document.getElementById('addUserModal').style.display = 'none';
        });
</script>


</body>
</html>
