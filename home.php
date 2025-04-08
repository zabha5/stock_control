<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Showcase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 dark:text-white">
    <!-- Light/Dark Mode Toggle -->
    <div class="fixed top-2 right-4 z-50">
        <button onclick="document.documentElement.classList.toggle('dark')" class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-600">
            <i class="ph ph-moon"></i>
        </button>
    </div>

    <!-- Header -->
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center fixed top-0 w-full z-40 shadow-md">
        <div class="flex items-center space-x-6 ml-4 font-bold">
            <span class="cursor-pointer hover:text-gray-300 flex items-center gap-1"><i class="ph ph-house"></i> Home</span>
            <span class="cursor-pointer hover:text-gray-300 flex items-center gap-1"><i class="ph ph-info"></i> About</span>
            <span class="cursor-pointer hover:text-gray-300 flex items-center gap-1"><i class="ph ph-phone"></i> Contact</span>
        </div>
        <input type="text" placeholder="Search Product..." class="w-64 p-2 rounded-lg text-gray-800 outline-none" />
    </header>

    <!-- Ad Carousel -->
    <div class="pt-20 px-4">
        <div class="w-full overflow-hidden rounded-xl shadow-md mb-4">
            <div class="carousel relative">
                <div class="flex transition-transform duration-900 ease-in-out" id="carousel-inner">
                    <img src="uploads/1743873592_istockphoto-1350560575-612x612.jpg" class="w-full h-8 object-cover" />
                    <img src="uploads/1743874266_dr-martens-1461-womens-shoes-oxblood-4.jpg" class="w-full h-8 object-cover" />
                    <img src="uploads/1743928422_images.jpeg" class="w-full h-8 object-cover" />
                </div>
            </div>
        </div>
    </div>

    <div class="flex px-4 gap-4">
        <!-- Left Sidebar -->
        <aside class="w-1/6 bg-white dark:bg-gray-800 rounded-xl p-4 shadow-md hidden md:block">
            <h2 class="text-lg font-semibold mb-3 border-b pb-1">Categories</h2>
            <ul class="space-y-4 text-gray-700 dark:text-gray-300 text-sm">
                <li><a href="#" class="hover:text-[#1abc9c] flex items-center gap-2"><i class="ph ph-device-mobile"></i> Electronics</a></li>
                <li><a href="#" class="hover:text-[#1abc9c] flex items-center gap-2"><i class="ph ph-t-shirt"></i> Fashion</a></li>
                <li><a href="#" class="hover:text-[#1abc9c] flex items-center gap-2"><i class="ph ph-shopping-cart"></i> Grocery</a></li>
                <li><a href="#" class="hover:text-[#1abc9c] flex items-center gap-2"><i class="ph ph-pencil"></i> Stationery</a></li>
                <li><a href="#" class="hover:text-[#1abc9c] flex items-center gap-2"><i class="ph ph-dots-three"></i> Other</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="w-full md:w-4/6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php
            $conn = new mysqli("localhost", "root", "", "stock_control");
            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

            $sql = "SELECT product.*, categories.c_name AS c_name FROM product JOIN categories ON product.category_id = categories.category_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 flex flex-col items-center">
                        <img src="uploads/' . $row['image'] . '" alt="Product Image" class="w-full h-40 object-cover rounded-md mb-3">
                        <h3 class="text-lg font-bold text-[#1abc9c]">' . $row['name'] . '</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-300">Category: ' . $row['c_name'] . '</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">Price: $' . $row['price'] . '</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300 mb-3">Stock: ' . $row['quantity'] . '</p>
                        <button onclick="openModal(\'' . $row['product_id'] . '\')" class="bg-[#1abc9c] hover:bg-teal-600 text-white px-4 py-2 rounded flex items-center gap-1">
                            <i class="ph ph-shopping-bag"></i> Buy
                        </button>

                        <!-- Modal -->
                        <div id="modal-' . $row['product_id'] . '" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl p-6 w-11/12 sm:w-96 relative">
                                <button onclick="closeModal(\'' . $row['product_id'] . '\')" class="absolute top-2 right-3 text-xl text-gray-600 hover:text-red-600">&times;</button>
                                <h2 class="text-xl font-bold mb-2">Purchase: ' . $row['name'] . '</h2>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">Category: ' . $row['c_name'] . '</p>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">Price: $' . $row['price'] . '</p>
                                <form method="POST" action="buy_product.php">
                                    <input type="hidden" name="product_id" value="' . $row['product_id'] . '">
                                    <input type="number" name="quantity" min="1" max="' . $row['quantity'] . '" placeholder="Quantity" required class="w-full mb-3 p-2 border rounded">
                                    <button type="submit" class="bg-[#1abc9c] w-full text-white py-2 rounded hover:bg-teal-700">Confirm Purchase</button>
                                </form>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p class='text-gray-600'>No products found.</p>";
            }

            $conn->close();
            ?>
        </main>

        <!-- Right Sidebar (Ads) -->
        <aside class="w-1/6 bg-white dark:bg-gray-800 rounded-xl p-4 shadow-md hidden lg:block">
            <h2 class="text-lg font-semibold mb-3 border-b pb-1">Sponsored</h2>
            <div class="mb-4">
                <img src="uploads/1743928422_images.jpeg" alt="Ad 1" class="rounded-xl w-full">
            </div>
            <div class="mb-4">
                <img src="uploads/1743874266_dr-martens-1461-womens-shoes-oxblood-4.jpg" alt="Ad 2" class="rounded-xl w-full">
            </div>
            <div class="mb-4">
                <img src="uploads/1743928422_images.jpeg" alt="Ad 3" class="rounded-xl w-full">
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white p-4 text-center mt-10">
        &copy; <?php echo date('Y'); ?> Nshakira by ZABHA. All rights reserved.
    </footer>

    <!-- JS for modals and carousel -->
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }

        // Simple Carousel
        let index = 0;
        setInterval(() => {
            const carousel = document.getElementById('carousel-inner');
            const total = carousel.children.length;
            index = (index + 1) % total;
            carousel.style.transform = `translateX(-${index * 100}%)`;
        }, 3000);
    </script>
</body>
</html>
