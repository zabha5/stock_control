

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for graphs -->
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


  
</body>

</html>
