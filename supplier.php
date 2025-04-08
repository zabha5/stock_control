<?php
require_once('process/config.php'); // Connect to the database
$sql = "SELECT * FROM suppliers";  // Modify with your table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
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
            transition: transform 0.1s ease-in-out;
        }

        .card:hover {
            transform: scale(1.009);
        }

        .sidebar a {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease;
            background-color: #e0f7f4;
        }

        .sidebar a:hover {
            background-color: #e0f7f4;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
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
            <li class="mb-4 font-bold"><a href="stock_out.php" class="ml-4">Stock Out</a></li>
            <li class="mb-4 font-bold"><a href="sales.php" class="ml-4">Sales</a></li>
            <li class="mb-4 font-bold"><a href="returns.php" class="ml-4">Returns</a></li>
            <li class="mb-4 font-bold"><a href="users.php" class="ml-4">Users</a></li>
            <li class="mb-4 font-bold"><a href="supplier.php" class="ml-4 text-[#1abc9c] text-sm">Supplier</a></li>
            <li class="mb-4 font-bold"><a href="report.php" class="ml-4">Reports</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">Supplier Management</h1>

        <!-- Search Bar -->
        <div class="mb-6 flex items-center space-x-4">
            <input type="text" class="w-full p-2 border rounded-md" placeholder="Search Supplier">
            <button class="bg-teal-500 text-white py-2 px-4 rounded-md hover:bg-teal-600" id="openAddSupplierModal">Add Supplier</button>
        </div>

        <!-- Supplier Table -->
        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto bg-white p-4 rounded-lg shadow">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b font-medium">
                            <th class="px-6 py-3">Supplier Name</th>
                            <th class="px-6 py-3">Contact</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-4"><?= htmlspecialchars($row['supplier_name']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['contact']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($row['status']) ?></td>
                                <td class="px-6 py-4">
                                    <button class="bg-teal-500 text-white px-4 py-1 rounded-md hover:bg-teal-600">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-1 rounded-md hover:bg-red-600">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-red-500 font-semibold">No suppliers found.</p>
        <?php endif; ?>
    </div>

    <!-- Add Supplier Modal -->
    <div id="addSupplierModal" class="modal">
        <div class="modal-content relative">
            <span class="close-btn" id="closeAddSupplierModal">&times;</span>
            <h3>Create New Supplier</h3>
            <?php if (isset($error1)) { ?>
            <div class="bg-red-500 text-white text-center p-2 rounded mb-4"><?php echo $error1; ?></div>
        <?php } ?>
            <form action="create_supplier.php" method="POST" class="space-y-4">
                <input type="text" name="supplier_name" placeholder="Supplier Name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                <input type="text" name="contact" placeholder="Contact Info" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                <select name="status" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button type="submit" name="create_supplier" class="w-full bg-teal-500 text-white py-2 rounded-md hover:bg-teal-600">Create Supplier</button>
            </form>
        </div>
    </div>

    <script>
        // Open the add supplier modal
        document.getElementById('openAddSupplierModal').onclick = function() {
            document.getElementById('addSupplierModal').style.display = 'block';
        };

        // Close the add supplier modal
        document.getElementById('closeAddSupplierModal').onclick = function() {
            document.getElementById('addSupplierModal').style.display = 'none';
        };

        // Close the modal if clicked outside
        window.onclick = function(event) {
            if (event.target === document.getElementById('addSupplierModal')) {
                document.getElementById('addSupplierModal').style.display = 'none';
            }
        };
    </script>
</body>
</html>
