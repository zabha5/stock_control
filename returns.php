<?php
// Database connection
require_once('process/config.php'); // Connect to the database

// Fetch return records
$sql = "SELECT 
            returns.return_id, 
            product.name AS product_name, 
            categories.c_name AS category, 
            returns.quantity_returned, 
            returns.return_reason, 
            returns.return_time,
            users.username AS returned_by,
            customer.name AS customer_name
        FROM returns
        JOIN product ON returns.product_id = product.product_id
        JOIN categories ON product.category_id = categories.category_id
        LEFT JOIN users ON returns.returned_by = users.user_id
        LEFT JOIN customer ON returns.return_id = customer.customer_id
        ORDER BY returns.return_time DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Returns</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Your custom styles here */
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
            <li class="mb-4 font-bold "><a href="returns.php" class="ml-4 text-[#1abc9c] text-sm">Returns</a></li>
            <li class="mb-4 font-bold "><a href="users.php" class="ml-4">Users</a></li>
            <li class="mb-4 font-bold "><a href="#" class="ml-4">Supplier</a></li>
            <li class="mb-4 font-bold "><a href="#" class="ml-4">Reports</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">Product Returns</h1>

        <!-- Return Table -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b font-medium">
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Quantity Returned</th>
                            <th class="px-6 py-3">Return Reason</th>
                            <th class="px-6 py-3">Return Time</th>
                            <th class="px-6 py-3">Returned By</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-4"><?= htmlspecialchars($row['product_name']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['category']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['quantity_returned']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['return_reason']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['return_time']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['returned_by']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['customer_name']) ?></td>
                                <td class="px-6 py-4">
                                    <button class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-red-500 font-semibold">No return records found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
