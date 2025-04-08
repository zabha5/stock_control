<?php

require_once('process/config.php'); // Connect to the database

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
      width: 90%;
      max-width: 500px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 18px;
      cursor: pointer;
    }

    #scroll {
      overflow-x: auto;
      height: 550px;
    }
  </style>
</head>

<body class="min-h-screen">
  <?php
  $showProductModal = isset($_GET['show']) && $_GET['show'] === 'product';
  $showCategoryModal = isset($_GET['show']) && $_GET['show'] === 'category';
  ?>

  <div class="flex flex-col sm:flex-row">
    <!-- Mobile Sidebar Toggle -->
    <div class="sm:hidden p-4">
      <button id="toggleSidebar" class="bg-[#1abc9c] text-white px-4 py-2 rounded">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="w-64 sidebar h-screen shadow-lg p-6 hidden sm:block">
      <h1 class="text-2xl font-bold mb-6 text-[#1abc9c]">Stock System</h1>
      <ul>
        <li class="mb-4 font-bold"><a href="dashboard.php" class="ml-4">Dashboard</a></li>
        <li class="mb-4 font-bold"><a href="product.php" class="ml-4 text-[#1abc9c] text-sm">Products</a></li>
        <li class="mb-4 font-bold"><a href="stock_out.php" class="ml-4">Stock Out</a></li>
        <li class="mb-4 font-bold"><a href="sales.php" class="ml-4">Sales</a></li>
        <li class="mb-4 font-bold"><a href="returns.php" class="ml-4">Returns</a></li>
        <li class="mb-4 font-bold"><a href="users.php" class="ml-4">Users</a></li>
        <li class="mb-4 font-bold"><a href="supplier.php" class="ml-4">Supplier</a></li>
        <li class="mb-4 font-bold"><a href="#" class="ml-4">Reports</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-2">
      <!-- Action Buttons & Search -->
      <div class="p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
        <button id="openProductModal"
          class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition duration-200 ease-in-out">
          Add Product
        </button>

        <div class="w-full sm:w-1/3 bg-white rounded-xl shadow-lg overflow-hidden p-4">
          <input type="text" id="searchInput" placeholder="Search for products..."
            class="w-full p-3 rounded-xl border border-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#1abc9c] text-gray-700 font-semibold placeholder:text-gray-500 transition duration-200 ease-in-out" />
        </div>

        <button id="openModal"
          class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition duration-200 ease-in-out">
          Add New Category
        </button>
      </div>

      <!-- Category Filter -->
      <div class="mb-4">
        <form method="GET" action="" class="inline">
          <select name="filter_category" onchange="this.form.submit()" class="border p-2 rounded">
            <option value="">All Categories</option>
            <?php
            $catResult = $conn->query("SELECT * FROM categories");
            while ($catRow = $catResult->fetch_assoc()) {
              $selected = isset($_GET['filter_category']) && $_GET['filter_category'] == $catRow['category_id'] ? 'selected' : '';
              echo "<option value='{$catRow['category_id']}' $selected>{$catRow['c_name']}</option>";
            }
            ?>
          </select>
        </form>
      </div>

      <div id="scroll" class="rounded-xl">
        <div class="bg-white p-4 rounded-xl shadow mb-6 overflow-x-auto w-full">
          <table class="min-w-full divide-y divide-gray-200 text-sm sm:text-base" id="productGrid">
            <thead class="bg-[#1abc9c] text-white">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N-</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
              $filter = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';
              $sql = "SELECT product.*, categories.c_name FROM product JOIN categories ON product.category_id = categories.category_id";
              if (!empty($filter)) {
                $sql .= " WHERE product.category_id = '" . $conn->real_escape_string($filter) . "'";
              }
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '
                    <tr class="card" data-name="' . strtolower($row['name']) . '' . strtolower($row['c_name']) . ' ">
                    <td class="px-6 py-4 text-gray-600">' . $row['product_id'] . '</td>
                      <td class="px-6 py-4">
                        <img src="uploads/' . $row['image'] . '" class="w-12 h-12 rounded-full object-cover" alt="Product Image">
                      </td>
                      <td class="px-6 py-4 font-semibold text-gray-800">' . $row['name'] . '</td>
                      <td class="px-6 py-4 text-gray-600">' . $row['c_name'] . '</td>
                      <td class="px-6 py-4 text-gray-600">$' . $row['price'] . '</td>
                      <td class="px-6 py-4 text-gray-600">' . $row['quantity'] . '</td>
                      <td class="px-6 py-4">
                        <div class="flex space-x-2">
                          <button class="bg-[#1abc9c] text-white px-4 py-1 rounded hover:bg-teal-600 text-sm">Edit</button>
                          <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 text-sm">Delete</button>
                        </div>
                      </td>
                    </tr>';
                }
              } else {
                echo '<tr><td colspan="6" class="px-6 py-4 text-gray-500">No products found.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add Product Modal -->
    <div id="productModal" class="modal">
      <div class="modal-content relative">
        <span class="close-btn" id="closeProductModal">&times;</span>
        <h3 class="text-xl font-semibold text-[#1abc9c] mb-4">Add New Product</h3>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
          <label for="name" class="block text-gray-600">Product Name</label>
          <input type="text" name="name" id="name" required class="w-full p-3 mb-4 border rounded-lg">

          <label for="category" class="block text-gray-600">Category</label>
          <select name="category_id" id="category" required class="w-full p-3 mb-4 border rounded-lg">
            <?php
            $categories = $conn->query("SELECT * FROM categories");
            while ($category = $categories->fetch_assoc()) {
              echo "<option value='{$category['category_id']}'>{$category['c_name']}</option>";
            }
            ?>
          </select>

          <label for="price" class="block text-gray-600">Price</label>
          <input type="number" name="price" id="price" required class="w-full p-3 mb-4 border rounded-lg">

          <label for="quantity" class="block text-gray-600">Quantity</label>
          <input type="number" name="quantity" id="quantity" required class="w-full p-3 mb-4 border rounded-lg">

          <label for="image" class="block text-gray-600">Image</label>
          <input type="file" name="image" id="image" required class="w-full p-3 mb-4 border rounded-lg">

          <button type="submit" name="submit" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 w-full">Submit</button>
        </form>
      </div>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="modal">
      <div class="modal-content relative">
        <span class="close-btn" id="closeCategoryModal">&times;</span>
        <h3 class="text-xl font-semibold text-[#1abc9c] mb-4">Add New Category</h3>
        <form action="category.php" method="POST">
          <label for="c_name" class="block text-gray-600">Category Name</label>
          <input type="text" name="c_name" id="c_name" required class="w-full p-3 mb-4 border rounded-lg">
          <button type="submit" name="add_category" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 w-full">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Modal handling
    document.getElementById('openProductModal').addEventListener('click', () => {
      document.getElementById('productModal').style.display = 'flex';
    });
    document.getElementById('closeProductModal').addEventListener('click', () => {
      document.getElementById('productModal').style.display = 'none';
    });
    document.getElementById('openModal').addEventListener('click', () => {
      document.getElementById('categoryModal').style.display = 'flex';
    });
    document.getElementById('closeCategoryModal').addEventListener('click', () => {
      document.getElementById('categoryModal').style.display = 'none';
    });

    // Sidebar toggle for mobile
    document.getElementById('toggleSidebar').addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('hidden');
    });

    // Search filter
    document.getElementById('searchInput').addEventListener('input', function () {
      const searchQuery = this.value.toLowerCase();
      const rows = document.querySelectorAll('#productGrid tbody tr');
      rows.forEach(row => {
        const productName = row.dataset.name;
        row.style.display = productName.includes(searchQuery) ? '' : 'none';
      });
    });
  </script>
</body>

</html>
