<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:login.php');
}
require_once('process/config.php');
$total_price = 0;

$sql = "SELECT SUM(price * quantity) AS total_price FROM product";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_price = $row['total_price'];
}

$productCount = $conn->query("SELECT COUNT(*) AS count FROM product")->fetch_assoc()['count'];
$stockOutCount = $conn->query("SELECT COUNT(*) AS count FROM product WHERE quantity = 0")->fetch_assoc()['count'];
$salesCount = $conn->query("SELECT COUNT(*) AS count FROM sales")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responsive Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-color: #f3f4f6;
    }

    .sidebar a {
      display: block;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      background-color: #e0f7f4;
      transition: background-color 0.2s ease;
    }

    .sidebar a:hover {
      background-color: rgb(160, 245, 234);
    }

    .card:hover {
      transform: scale(1.03);
      transition: transform 0.2s;
    }
    #table-l{
        border-radius: 10px 0 0 10px;
    }
    #table-r{
        border-radius: 0 10px 10px 0;
    }
  </style>
</head>
<body class="font-sans min-h-screen flex flex-col lg:flex-row">

  <!-- Sidebar -->
  <aside class="w-full lg:w-64 md:w-full sm:w-full sidebar bg-white shadow-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-[#1abc9c]"><i class="ph ph-shopping-bag text-2xl text-primary-600"></i> ShopNest <br> <span class="text-sm text-black">Admin</span> </h1>
    <ul>
      <li class="mb-4 font-bold"><a href="dashboard.php" class="text-[#1abc9c] text-sm">Dashboard</a></li>
      <li class="mb-4 font-bold"><a href="product.php">Products</a></li>
      <li class="mb-4 font-bold"><a href="stock_out.php">Stock Out</a></li>
      <li class="mb-4 font-bold"><a href="sales.php">Sales</a></li>
      <li class="mb-4 font-bold"><a href="returns.php">Returns</a></li>
      <li class="mb-4 font-bold"><a href="users.php">Users</a></li>
      <li class="mb-4 font-bold"><a href="supplier.php">Supplier</a></li>
      <li class="mb-4 font-bold"><a href="report.php">Reports</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-4 sm:p-6">
    <!-- Header -->
    <header class="bg-[#1abc9c] text-white rounded-xl p-4 mb-6 shadow-md">
      <h2 class="text-2xl sm:text-3xl font-bold">System Dashboard</h2>
    </header>

    <!-- Stats -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
      <div class="bg-white p-6 rounded-xl shadow-md card">
        <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
        <p class="text-4xl font-bold text-[#1abc9c]"><?= $productCount ?></p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md card">
        <h3 class="text-lg font-semibold text-gray-700">Stock Outs</h3>
        <p class="text-4xl font-bold text-red-500"><?= $stockOutCount ?></p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md card">
        <h3 class="text-lg font-semibold text-gray-700">Sales Records</h3>
        <p class="text-4xl font-bold text-[#1abc9c]"><?= $salesCount ?></p>
      </div>
    </section>

    <!-- Product Overview -->
    <section class=" grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-white p-2 rounded-xl shadow-md mb-6">

        <h3 class="text-xl sm:text-2xl font-semibold text-[#1abc9c] mb-4">
    Latest Products 
    <span class="mx-24 text-red-500">Total: $ <?php echo number_format($total_price, 2); ?></span>
</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-2 gap-6">

          <table class="min-w-full divide-y divide-gray-200 text-sm sm:text-base" id="productGrid">
          <thead class="bg-[#1abc9c] text-white w-full"> 
              <tr>
                <th id="table-l" class="px-14  py-3 text-left text-xs font-medium uppercase tracking-wider">Product</th>
                <th class="px-10  py-3 text-left text-xs font-medium uppercase tracking-wider">Category</th>
                <th class="px-10  py-3 text-left text-xs font-medium uppercase tracking-wider">Quantity</th>
                <th id="table-r" class="px-10  py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                 $sql = mysqli_query($conn, "SELECT product.*, categories.c_name FROM product JOIN categories ON product.category_id = categories.category_id ORDER BY product.product_id DESC LIMIT 5");
                 while($row = mysqli_fetch_assoc($sql)){
                    echo '
                    <tr>
                    <td class="px-6 py-2">
                        <img src="uploads/' . $row['image'] . '" class="w-12 h-12 mx-6 rounded-full object-cover" alt="Product Image">
                        </td>
                      <td class="px-6 py-2">' . $row['c_name'] . '</td>
                      <td class="px-6 py-2">' . $row['quantity'] . '</td>
                      <td class="px-6 py-2">$' . $row['price'] . '</td>
                    </tr>
                    
                    ';
                 }

                ?>

           </tbody>

          </table>


   
        </div>
    </div>
    <div class="bg-white p-4 rounded-xl shadow-md mb-6">
    <h3 class="text-xl sm:text-2xl font-semibold text-[#1abc9c] mb-4">Latest Sales</h3>
    </div>
    </section>
  </main>
</body>
</html>
