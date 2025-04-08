<?php
require_once('process/config.php'); // Connect to the database
$sql = "SELECT 
            sales.sale_id,
            product.name AS product_name,
            customer.name AS customer_name,
            sales.quantity_sold,
            sales.total_price,
            sales.payment_method,
            sales.discount,
            sales.sale_time
        FROM sales
        JOIN product ON sales.product_id = product.product_id
        LEFT JOIN customer ON sales.sold_to = customer.customer_id
        ORDER BY sales.sale_time DESC";


$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales</title>
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
<body class="flex min-h-screen bg-gray-100">
<!-- Sidebar -->
<div class="w-64 sidebar h-screen shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-[#1abc9c]">Stock System</h1>
        <ul>
            <li class="mb-4 font-bold"><a href="dashboard.php" class="ml-4">Dashboard</a></li>
            <li class="mb-4 font-bold"><a href="product.php" class="ml-4">Products</a></li>
            <li class="mb-4 font-bold"><a href="stock_out.php" class="ml-4 ">Stock Out</a></li>
            <li class="mb-4 font-bold"><a href="sales.php" class="ml-4 text-[#1abc9c] text-sm">Sales</a></li>
            <li class="mb-4 font-bold"><a href="returns.php" class="ml-4">Returns</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Users</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Supplier</a></li>
            <li class="mb-4 font-bold"><a href="#" class="ml-4">Reports</a></li>
        </ul>
</div>

<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Sales</h2>
        <button class="bg-[#1abc9c] text-white px-4 py-2 rounded" onclick="document.getElementById('addSaleModal').classList.remove('hidden')">+ New Sale</button>
    </div>

    <!-- Search & Filter -->
    <div class="flex flex-wrap gap-4 mb-4">
        <input type="text" placeholder="Search product/category..." class="p-2 border rounded w-1/4">
        <input type="date" class="p-2 border rounded">
        <input type="date" class="p-2 border rounded">
        <select class="p-2 border rounded">
            <option value="">Filter by User</option>
            <!-- Load dynamically -->
        </select>
    </div>

    <!-- Sales Table -->
    <div class="bg-white rounded-lg shadow p-4 overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr class="bg-gray-100 border-b font-semibold">
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Total Price</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Sold By</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['product_name']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['category']) ?></td>
                            <td class="px-4 py-2"><?= $row['quantity_sold'] ?></td>
                            <td class="px-4 py-2"><?= number_format($row['total_price'], 2) ?> RWF</td>
                            <td class="px-4 py-2"><?= $row['sale_time'] ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['sold_by']) ?></td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="text-blue-500">View</button>
                                <button class="text-yellow-500">Edit</button>
                                <button class="text-red-500">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4 text-red-500">No sales found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Report Summary Placeholder -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-2">Sales Summary</h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">Today: 0 RWF</div>
            <div class="bg-white p-4 rounded shadow">This Week: 0 RWF</div>
            <div class="bg-white p-4 rounded shadow">This Month: 0 RWF</div>
        </div>
    </div>
</div>

<!-- Add Sale Modal -->
<div id="addSaleModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg w-[500px]">
        <h2 class="text-xl font-bold mb-4">Add New Sale</h2>
        <form method="POST" action="add_sale.php">
            <select name="product_id" class="w-full p-2 mb-2 border rounded">
                <option value="">Select Product</option>
                <!-- Populate with product list -->
            </select>
            <input type="number" name="quantity" placeholder="Quantity" class="w-full p-2 mb-2 border rounded">
            <input type="number" name="discount" placeholder="Discount (optional)" class="w-full p-2 mb-2 border rounded">
            <select name="payment_method" class="w-full p-2 mb-2 border rounded">
                <option value="Cash">Cash</option>
                <option value="Mobile Money">Mobile Money</option>
            </select>
            <select name="sold_to" class="w-full p-2 mb-2 border rounded">
                <option value="">Walk-in Customer</option>
                <!-- Populate with customers if needed -->
            </select>
            <button type="submit" class="bg-[#1abc9c] text-white px-4 py-2 rounded">Submit</button>
            <button type="button" onclick="document.getElementById('addSaleModal').classList.add('hidden')" class="ml-2 text-gray-500">Cancel</button>
        </form>
    </div>
</div>

</body>
</html>
<?php $conn->close(); ?>