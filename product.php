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
    <link href="./tailwind.min.css" rel="stylesheet">
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
      max-width: 600px;
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
    .cursor-pointer{
      margin-left: 95%;
    }
    #scroll-category{
      overflow-y: auto;
      overflow-x: hidden;
      height: 400px;
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
   <?php
   require('./process/sidebar.php');
   ?>

    <!-- Main Content -->
    <div class="flex-1 p-2">
      <!-- Action Buttons & Search -->
      <div class="p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
        <button id="addProductButton"
          class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 transition duration-200 ease-in-out">
          Add Product
        </button>

        <div class="w-full sm:w-1/3 bg-white rounded-xl shadow-lg overflow-hidden p-4">
          <input type="text" id="searchInput" placeholder="Search for products..."
            class="w-full p-3 rounded-xl border border-[#1abc9c] focus:outline-none focus:ring-2 focus:ring-[#1abc9c] text-gray-700 font-semibold placeholder:text-gray-500 transition duration-200 ease-in-out" />
        </div>

        <button id="addCategoryButton"
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
                          <button class="edit-product-btn bg-[#1abc9c] text-white px-4 py-1 rounded hover:bg-teal-600 text-sm">Edit</button>
                          <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 text-sm">Delete</button>
                        </div>
                      </td>
                    </tr>';
                    
                }
              } else {
                // Updated message with correct colspan and styling
                echo '<tr>
                        <td colspan="7" class="px-6 py-4 text-center bg-red-50 text-red-800 font-semibold">
                          No products found in the database.
                        </td>
                      </tr>';
              }
              ?>
            </tbody>
          </table>
          <div id="noProductMessage" class="hidden p-4 mb-4 bg-red-50 text-red-800 rounded-lg text-center">
            No products match your search criteria.
          </div>
        </div>
      </div>
    </div>

    <!-- Add Product Modal -->
    <div id="productModal" class="modal">
      <div class="modal-content relative">
        <span class="close-btn px-2 hover:bg-red-500 hover:rounded hover:text-white" id="closeProductModal">&times;</span>
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
        <span class="close-btn px-2 hover:bg-red-500 hover:px-2 hover:rounded" id="closeCategoryModal">&times;</span>
        <h3 class="text-xl font-semibold text-[#1abc9c] mb-4">Add New Category</h3>
        <form action="category.php" method="POST">
          <label for="c_name" class="block text-gray-600">Category Name</label>
          <input type="text" name="c_name" id="c_name" required class="w-full p-3 mb-4 border rounded-lg">
          <button type="submit" name="add_category" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 w-full">Submit</button>
        </form>
        <!-- seacrh bar -->
        <input type="text" id="searchCategoryInput" placeholder="Search for categories..."
          class="w-3/4 p-2 rounded-xl border focus:outline-none focus:ring-2 m-2  
          focus:ring-[#1abc9c] text-gray-700 font-semibold placeholder:text-gray-500 transition duration-200 ease-in-out" />
        <div class="border rounded p-2 m-2" id="scroll-category">
  
         <table class="min-w-full divide-y divide-gray-200 text-sm sm:text-base">
           <tr class="bg-[#1abc9c] text-white">
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Category Name</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
           </tr>
           <?php
           $sql = "SELECT * FROM categories";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
               echo '<tr class="card">
               <td class="px-6 py-4 border-b text-xl">.</td>
               <td class="px-6 py-4 border-b">'. $row['c_name'] .'</td> 
               <td class="px-6 py-4 border-b">
               <div class="flex space-x-2">
                          <button class="edit-product-btn bg-[#1abc9c] text-white px-4 py-1 rounded hover:bg-teal-600 text-sm">Edit</button>
                          <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 text-sm">Delete</button>
                        </div>
               </td>
               </tr>';

             } 
           }
    
        ?>
         </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Model -->   
  <div id="updateProductModal" class="modal">
    <div class="modal-content bg-white p-4 rounded-xl shadow">
      <span class="cursor-pointer px-2 hover:bg-red-500 rounded-xl" id="closeUpdateProductModal">&times;</span>
      <h3 class="text-xl font-semibold text-[#1abc9c] mb-4">Update Product</h3>
      <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="product_id" id="modalProductId">
        <label for="modalName" class="block text-gray-600">Product Name</label>
        <input type="text" name="name" id="modalName" required class="w-full p-3 mb-4 border rounded-lg">

        <label for="modalCategory" class="block text-gray-600">Category</label>
        <select name="category_id" id="modalCategory" required class="w-full p-3 mb-4 border rounded-lg">
          <?php
          $categories = $conn->query("SELECT * FROM categories");
          while ($category = $categories->fetch_assoc()) {
            echo "<option value='{$category['category_id']}'>{$category['c_name']}</option>";
          }
          ?>
        </select>

        <label for="modalPrice" class="block text-gray-600">Price</label>
        <input type="number" name="price" id="modalPrice" required class="w-full p-3 mb-4 border rounded-lg">

        <label for="modalQuantity" class="block text-gray-600">Quantity</label>
        <input type="number" name="quantity" id="modalQuantity" required class="w-full p-3 mb-4 border rounded-lg">

        <label for="modalImage" class="block text-gray-600">Image</label>
        <input type="file" name="image" id="modalImage" class="w-full p-3 mb-4 border rounded-lg">
        <div id="currentImageContainer" class="mb-4"></div>

        <button type="submit" name="update_product" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg hover:bg-teal-600 w-full">Update</button>
      </form>
    </div>
  </div>

  <script>
    // Modal handling
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchQuery = this.value.toLowerCase();
      const rows = document.querySelectorAll('#productGrid tbody tr');
      let hasVisible = false;
      
      rows.forEach(row => {
        if (row.querySelector('td[colspan]')) return;
        const productName = row.dataset.name;
        const isVisible = productName.includes(searchQuery);
        row.style.display = isVisible ? '' : 'none';
        if (isVisible) hasVisible = true;
      });

      const noProductMessage = document.getElementById('noProductMessage');
      noProductMessage.style.display = hasVisible ? 'none' : 'block';
    });

    // Update Modal - New Implementation
    document.querySelectorAll('.edit-product-btn').forEach(button => {
      button.addEventListener('click', function() {
        const row = this.closest('tr');
        const productId = row.querySelector('td:first-child').textContent;
        const productName = row.querySelector('td:nth-child(3)').textContent;
        const category = row.querySelector('td:nth-child(4)').textContent;
        const price = row.querySelector('td:nth-child(5)').textContent.replace('$', '');
        const quantity = row.querySelector('td:nth-child(6)').textContent;
        const imageSrc = row.querySelector('img').src;
        
        // Populate modal fields
        document.getElementById('modalProductId').value = productId;
        document.getElementById('modalName').value = productName;
        document.getElementById('modalPrice').value = price;
        document.getElementById('modalQuantity').value = quantity;
        
        // Set category selection
        const categorySelect = document.getElementById('modalCategory');
        for (let i = 0; i < categorySelect.options.length; i++) {
          if (categorySelect.options[i].text === category) {
            categorySelect.selectedIndex = i;
            break;
          }
        }
        
        // Show current image
        const imageContainer = document.getElementById('currentImageContainer');
        imageContainer.innerHTML = `
          <p class="text-sm text-gray-600 mb-2">Current Image:</p>
          <img src="${imageSrc}" class="w-20 h-20 rounded object-cover">
        `;
        
        // Show modal
        document.getElementById('updateProductModal').style.display = 'flex';
      });
    });
          
    // Close Update Modal
    document.getElementById('closeUpdateProductModal').addEventListener('click', function() {
      document.getElementById('updateProductModal').style.display = 'none';
    });
  
      // Sidebar Toggle for Mobile
      const toggleSidebarButton = document.getElementById('toggleSidebar');
      const sidebar = document.getElementById('sidebar');
  
      toggleSidebarButton.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('block');
      });
      // add category
      const addCategoryButton = document.getElementById('addCategoryButton');
      const categoryModal = document.getElementById('categoryModal');

      addCategoryButton.addEventListener('click', function () {
        categoryModal.style.display = 'flex';
        
        });

      // Close Category Modal
      document.getElementById('closeCategoryModal').addEventListener('click', function() {
        document.getElementById('categoryModal').style.display = 'none';
      });
      //  add product
      const addProductButton = document.getElementById('addProductButton');
      const productModal = document.getElementById('productModal');

      addProductButton.addEventListener('click', function () {
        productModal.style.display = 'flex';

        });
      // Close Product Modal  
      document.getElementById('closeProductModal').addEventListener('click', function() {
        document.getElementById('productModal').style.display = 'none'; 

      });



  </script>
</body>

</html>
