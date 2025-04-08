<?php
require_once('process/config.php'); // Connect to the database

$sql = "SELECT product.name AS product_name, categories.c_name AS product_category, product.price, product.image, 
        stock_out.quantity AS out_quantity, stock_out.reason, stock_out.out_time 
        FROM stock_out 
        JOIN product ON stock_out.product_id = product.product_id 
        JOIN categories ON product.category_id = categories.category_id 
        WHERE stock_out.quantity > 0";


$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Out Products</title>
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
            background-color: rgb(160, 245, 234);
        }
        #scroll {
            overflow: auto;
            height: 600px;
        }
    </style>
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 sidebar h-screen shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-[#1abc9c]">Stock System</h1>
        <ul>
            <li class="mb-4 font-bold"><a href="dashboard.php" class="ml-4">Dashboard</a></li>
            <li class="mb-4 font-bold"><a href="product.php" class="ml-4">Products</a></li>
            <li class="mb-4 font-bold"><a href="stock_out.php" class="ml-4 text-[#1abc9c] text-sm">Stock Out</a></li>
            <li class="mb-4 font-bold"><a href="sales.php" class="ml-4">Sales</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Returns</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Users</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Supplier</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Reports</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="main-header rounded-xl text-white p-4 mb-6 shadow-md">
            <h2 class="text-3xl font-bold">Stock Out Products</h2>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b font-medium">
                        <th class="px-6 py-3">Image</th>
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Quantity Out</th>
                            <th class="px-6 py-3">Reason</th>
                            <th class="px-6 py-3">Out Time</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-b hover:bg-gray-100">
                               <td class="px-6 py-4">
                                    <img src="uploads/<?= $row['image'] ?>" alt="Product Image" class="h-12 w-12 object-cover rounded">
                                </td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['product_name']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['product_category']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['price']) ?> $</td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['out_quantity']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['reason']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['out_time']) ?></td>
                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-red-500 font-semibold">No stock out products found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
