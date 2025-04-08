<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "stock_control";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total revenue today, this week, and this month
$totalRevenueTodaySql = "SELECT SUM(total_price) AS total_today FROM sales WHERE DATE(sale_time) = CURDATE()";
$totalRevenueWeekSql = "SELECT SUM(total_price) AS total_week FROM sales WHERE WEEK(sale_time) = WEEK(CURDATE())";
$totalRevenueMonthSql = "SELECT SUM(total_price) AS total_month FROM sales WHERE MONTH(sale_time) = MONTH(CURDATE())";
$bestSellingProductsSql = "SELECT product.name AS product_name, SUM(sales.quantity_sold) AS total_sold FROM sales JOIN product ON sales.product_id = product.product_id GROUP BY product.product_id ORDER BY total_sold DESC LIMIT 5";
$salesByCategorySql = "SELECT categories.c_name AS category, SUM(sales.total_price) AS category_sales FROM sales JOIN product ON sales.product_id = product.product_id JOIN categories ON product.category_id = categories.category_id GROUP BY categories.category_id ORDER BY category_sales DESC";

$revenueToday = $conn->query($totalRevenueTodaySql)->fetch_assoc()['total_today'];
$revenueThisWeek = $conn->query($totalRevenueWeekSql)->fetch_assoc()['total_week'];
$revenueThisMonth = $conn->query($totalRevenueMonthSql)->fetch_assoc()['total_month'];
$bestSellingProducts = $conn->query($bestSellingProductsSql);
$salesByCategory = $conn->query($salesByCategorySql);

// Close the connection
$conn->close();
?>

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

        .report-card {
            transition: transform 0.2s ease-in-out;
        }

        .report-card:hover {
            transform: scale(1.05);
        }

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
     

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h2 {
            color: #1abc9c;
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

    <!-- Content Area -->
    <div class="flex-1 p-6">
    <div class="content">

        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-3xl font-semibold">Sales Report</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <div class="bg-teal-500 text-white p-6 rounded-lg report-card">
                    <h3 class="text-xl">Total Revenue Today</h3>
                    <p class="text-3xl font-semibold"><?= number_format($revenueToday, 2) ?> RWF</p>
                </div>
                <div class="bg-teal-500 text-white p-6 rounded-lg report-card">
                    <h3 class="text-xl">Total Revenue This Week</h3>
                    <p class="text-3xl font-semibold"><?= number_format($revenueThisWeek, 2) ?> RWF</p>
                </div>
                <div class="bg-teal-500 text-white p-6 rounded-lg report-card">
                    <h3 class="text-xl">Total Revenue This Month</h3>
                    <p class="text-3xl font-semibold"><?= number_format($revenueThisMonth, 2) ?> RWF</p>
                </div>
            </div>
        </div>

        <!-- Best Selling Products -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-2xl font-semibold text-[#1abc9c]">Best Selling Products</h3>
            <table class="min-w-full mt-4 table-auto">
                <thead>
                    <tr class="border-b font-medium">
                        <th class="px-4 py-2">Product Name</th>
                        <th class="px-4 py-2">Quantity Sold</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $bestSellingProducts->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['product_name']) ?></td>
                            <td class="px-4 py-2"><?= $row['total_sold'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Sales by Category -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-2xl font-semibold text-[#1abc9c]">Sales by Category</h3>
            <table class="min-w-full mt-4 table-auto">
                <thead>
                    <tr class="border-b font-medium">
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Sales (RWF)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $salesByCategory->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['category']) ?></td>
                            <td class="px-4 py-2"><?= number_format($row['category_sales'], 2) ?> RWF</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Graphs (Bar Chart & Pie Chart) -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-2xl font-semibold text-[#1abc9c]">Revenue Graph</h3>
            <div class="mt-6">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
                    </div>
    <script>
        // Bar chart for revenue
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today', 'This Week', 'This Month'],
                datasets: [{
                    label: 'Total Revenue (RWF)',
                    data: [<?= $revenueToday ?>, <?= $revenueThisWeek ?>, <?= $revenueThisMonth ?>],
                    backgroundColor: ['#1abc9c', '#3498db', '#f39c12'],
                    borderColor: ['#1abc9c', '#3498db', '#f39c12'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
