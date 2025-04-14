<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNest - Product Showcase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        };
    </script>
    <style>
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }
        .carousel-item {
            transition: opacity 0.5s ease-in-out;
        }
        .carousel-item.active {
            opacity: 1;
        }
        .carousel-item:not(.active) {
            opacity: 0;
            position: absolute;
        }
        .smooth-transition {
            transition: all 0.3s ease;
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 600;
        }
        .badge-new {
            background-color: #3b82f6;
            color: white;
        }
        .badge-sale {
            background-color: #ef4444;
            color: white;
        }
        .badge-stock {
            background-color: #10b981;
            color: white;
        }
        .badge-low {
            background-color: #f59e0b;
            color: white;
        }
        .badge-out {
            background-color: #64748b;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 dark:text-gray-100">
    <!-- Light/Dark Mode Toggle -->
 

    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-40">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Logo and Mobile Menu -->
            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="#" class="flex items-center gap-2">
                    <i class="ph ph-shopping-bag text-2xl text-primary-600"></i>
                    <span class="text-xl font-bold text-primary-600">ShopNest</span>
                </a>
                <button id="mobile-menu-button" class="md:hidden text-gray-700 dark:text-gray-300">
                    <i class="ph ph-list text-2xl"></i>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="w-full md:w-1/3 relative">
                <input type="text" placeholder="Search products..." 
                       class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 
                              focus:outline-none focus:ring-2 focus:ring-primary-500 dark:bg-gray-700">
                <i class="ph ph-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#" class="flex items-center gap-1 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                    <i class="ph ph-house"></i> Home
                </a>
                <a href="#" class="flex items-center gap-1 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                    <i class="ph ph-list"></i> Categories
                </a>
                <a href="#" class="flex items-center gap-1 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                    <i class="ph ph-heart"></i> Wishlist
                </a>
                <a href="#" class="flex items-center gap-1 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                    <i class="ph ph-user"></i> Account
                </a>
                <a href="#" class="flex items-center gap-1 relative">
                    <i class="ph ph-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 px-4 pb-4 shadow-md">
            <a href="#" class="block py-2 px-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="ph ph-house mr-2"></i> Home
            </a>
            <a href="#" class="block py-2 px-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="ph ph-list mr-2"></i> Categories
            </a>
            <a href="#" class="block py-2 px-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="ph ph-heart mr-2"></i> Wishlist
            </a>
            <a href="#" class="block py-2 px-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="ph ph-user mr-2"></i> Account
            </a>
        </div>
    </header>

    <!-- Hero Carousel -->
    <div class="relative mt-16 overflow-hidden">
        <div class="carousel-container h-64 md:h-96 w-full relative">
            <div class="carousel-item active">
                <img src="uploads/1743873592_istockphoto-1350560575-612x612.jpg" 
                     alt="Special Offer" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-3xl md:text-5xl font-bold mb-2">Summer Sale</h2>
                        <p class="text-lg md:text-xl mb-4">Up to 50% off on selected items</p>
                        <button class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-full">
                            Shop Now
                        </button>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploads/1743874266_dr-martens-1461-womens-shoes-oxblood-4.jpg" 
                     alt="New Collection" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-3xl md:text-5xl font-bold mb-2">New Arrivals</h2>
                        <p class="text-lg md:text-xl mb-4">Discover our latest collection</p>
                        <button class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-full">
                            Explore
                        </button>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="uploads/1743928422_images.jpeg" 
                     alt="Featured Products" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-3xl md:text-5xl font-bold mb-2">Featured Products</h2>
                        <p class="text-lg md:text-xl mb-4">Best sellers of the month</p>
                        <button class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-full">
                            View All
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Carousel Controls -->
            <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 text-gray-800 p-2 rounded-full shadow-md hover:bg-opacity-100 smooth-transition" onclick="prevSlide()">
                <i class="ph ph-caret-left"></i>
            </button>
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 text-gray-800 p-2 rounded-full shadow-md hover:bg-opacity-100 smooth-transition" onclick="nextSlide()">
                <i class="ph ph-caret-right"></i>
            </button>
            
            <!-- Indicators -->
            <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 smooth-transition" onclick="goToSlide(0)"></button>
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 smooth-transition" onclick="goToSlide(1)"></button>
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 smooth-transition" onclick="goToSlide(2)"></button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-1/5 bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 h-fit sticky top-24">
                <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <i class="ph ph-faders"></i> Filters
                </h2>
                
                <!-- Categories -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-2 flex items-center justify-between">
                        <span>Categories</span>
                        <i class="ph ph-caret-down"></i>
                    </h3>
                    <ul class="space-y-2 pl-2">
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                                <i class="ph ph-device-mobile"></i> Electronics
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                                <i class="ph ph-t-shirt"></i> Fashion
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                                <i class="ph ph-cooking-pot"></i> Home & Kitchen
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                                <i class="ph ph-book-open"></i> Books
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 smooth-transition">
                                <i class="ph ph-barbell"></i> Sports
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Price Range -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Price Range</h3>
                    <div class="px-2">
                        <input type="range" min="0" max="1000" value="500" class="w-full accent-primary-600">
                        <div class="flex justify-between text-sm text-gray-500 mt-1">
                            <span>$0</span>
                            <span>$1000</span>
                        </div>
                    </div>
                </div>
                
                <!-- Ratings -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Customer Ratings</h3>
                    <div class="space-y-2 pl-2">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="rating-4" class="accent-primary-600">
                            <label for="rating-4" class="flex items-center gap-1">
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <span class="text-xs text-gray-500 ml-1">& Up</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="rating-3" class="accent-primary-600">
                            <label for="rating-3" class="flex items-center gap-1">
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <span class="text-xs text-gray-500 ml-1">& Up</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="rating-2" class="accent-primary-600">
                            <label for="rating-2" class="flex items-center gap-1">
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star-fill text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <i class="ph ph-star text-yellow-400"></i>
                                <span class="text-xs text-gray-500 ml-1">& Up</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Availability -->
                <div>
                    <h3 class="font-semibold mb-2">Availability</h3>
                    <div class="space-y-2 pl-2">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="in-stock" class="accent-primary-600" checked>
                            <label for="in-stock">In Stock</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="out-of-stock" class="accent-primary-600">
                            <label for="out-of-stock">Out of Stock</label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <main class="w-full lg:w-4/5">
                <!-- Sorting and Results -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 mb-6 flex flex-col sm:flex-row justify-between items-center">
                    <div class="mb-3 sm:mb-0">
                        <span class="text-gray-600 dark:text-gray-300">Showing <span class="font-semibold">1-12</span> of <span class="font-semibold">48</span> products</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 dark:text-gray-300">Sort by:</span>
                        <select class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option>Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest Arrivals</option>
                            <option>Best Selling</option>
                            <option>Customer Reviews</option>
                        </select>
                    </div>
                </div>

                <!-- Product Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "stock_control");
                    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

                    $sql = "SELECT product.*, categories.c_name AS c_name FROM product 
                            JOIN categories ON product.category_id = categories.category_id
                            ORDER BY product.product_id DESC LIMIT 12";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Determine stock status
                            $stockStatus = '';
                            $stockBadge = '';
                            if ($row['quantity'] == 0) {
                                $stockStatus = 'Out of Stock';
                                $stockBadge = 'badge-out';
                            } elseif ($row['quantity'] < 5) {
                                $stockStatus = 'Low Stock';
                                $stockBadge = 'badge-low';
                            } else {
                                $stockStatus = 'In Stock';
                                $stockBadge = 'badge-stock';
                            }
                            
                            // Random badge for demo (new or sale)
                            $randomBadge = rand(0, 1) ? ['class' => 'badge-new', 'text' => 'New'] : ['class' => 'badge-sale', 'text' => 'Sale'];
                            
                            echo '
                            <div class="product-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden smooth-transition">
                                <!-- Product Image -->
                                <div class="relative">
                                    <img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '" 
                                         class="w-full h-48 object-cover hover:opacity-90 smooth-transition cursor-pointer">
                                    
                                    <!-- Badges -->
                                    <div class="absolute top-2 left-2 flex flex-col gap-1">
                                        <span class="' . $randomBadge['class'] . '">' . $randomBadge['text'] . '</span>
                                        <span class="' . $stockBadge . '">' . $stockStatus . '</span>
                                    </div>
                                    
                                    <!-- Quick Actions -->
                                    <div class="absolute top-2 right-2 flex flex-col gap-2 opacity-0 hover:opacity-100 smooth-transition">
                                        <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 smooth-transition">
                                            <i class="ph ph-heart text-gray-700"></i>
                                        </button>
                                        <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 smooth-transition">
                                            <i class="ph ph-eye text-gray-700"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Product Info -->
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-semibold text-lg truncate">' . $row['name'] . '</h3>
                                        <span class="text-primary-600 font-bold">$' . number_format($row['price'], 2) . '</span>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">' . $row['c_name'] . '</p>
                                    
                                    <!-- Rating -->
                                    <div class="flex items-center mb-3">
                                        <div class="flex text-yellow-400">
                                            <i class="ph ph-star-fill"></i>
                                            <i class="ph ph-star-fill"></i>
                                            <i class="ph ph-star-fill"></i>
                                            <i class="ph ph-star-fill"></i>
                                            <i class="ph ph-star"></i>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-1">(24)</span>
                                    </div>
                                    
                                    <!-- Add to Cart -->
                                    <button onclick="openModal(\'' . $row['product_id'] . '\')" 
                                            class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 rounded-lg flex items-center justify-center gap-2 smooth-transition"
                                            ' . ($row['quantity'] == 0 ? 'disabled' : '') . '>
                                        <i class="ph ph-shopping-cart"></i>
                                        ' . ($row['quantity'] == 0 ? 'Out of Stock' : 'Add to Cart') . '
                                    </button>
                                </div>
                                
                                <!-- Modal -->
                                <div id="modal-' . $row['product_id'] . '" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 p-4">
                                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 w-full max-w-md relative">
                                        <button onclick="closeModal(\'' . $row['product_id'] . '\')" 
                                                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-2xl smooth-transition">
                                            &times;
                                        </button>
                                        
                                        <div class="flex flex-col md:flex-row gap-6 mb-4">
                                            <div class="w-full md:w-1/3">
                                                <img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '" 
                                                     class="w-full rounded-lg object-cover">
                                            </div>
                                            <div class="w-full md:w-2/3">
                                                <h2 class="text-xl font-bold mb-1">' . $row['name'] . '</h2>
                                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">Category: ' . $row['c_name'] . '</p>
                                                <p class="text-2xl font-bold text-primary-600 mb-3">$' . number_format($row['price'], 2) . '</p>
                                                
                                                <div class="flex items-center mb-3">
                                                    <div class="flex text-yellow-400">
                                                        <i class="ph ph-star-fill"></i>
                                                        <i class="ph ph-star-fill"></i>
                                                        <i class="ph ph-star-fill"></i>
                                                        <i class="ph ph-star-fill"></i>
                                                        <i class="ph ph-star"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">(24 reviews)</span>
                                                </div>
                                                
                                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                                    ' . ($row['quantity'] > 0 ? 
                                                        '<span class="text-green-500"><i class="ph ph-check-circle"></i> In Stock (' . $row['quantity'] . ' available)</span>' : 
                                                        '<span class="text-red-500"><i class="ph ph-x-circle"></i> Out of Stock</span>') . '
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <form method="POST" action="buy_product.php" class="space-y-4">
                                            <input type="hidden" name="product_id" value="' . $row['product_id'] . '">
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                                                <div class="flex items-center gap-2">
                                                    <button type="button" onclick="decrementQuantity(this)" class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg">-</button>
                                                    <input type="number" name="quantity" min="1" max="' . $row['quantity'] . '" value="1" 
                                                           class="w-16 text-center border border-gray-300 dark:border-gray-600 rounded-lg py-1">
                                                    <button type="button" onclick="incrementQuantity(this)" class="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg">+</button>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-3">
                                                <button type="submit" 
                                                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white py-2 rounded-lg flex items-center justify-center gap-2 smooth-transition"
                                                        ' . ($row['quantity'] == 0 ? 'disabled' : '') . '>
                                                    <i class="ph ph-shopping-cart"></i> Add to Cart
                                                </button>
                                                <button type="button" 
                                                        class="w-12 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 py-2 rounded-lg flex items-center justify-center smooth-transition">
                                                    <i class="ph ph-heart"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="col-span-full text-center py-10">
                                <i class="ph ph-package text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 dark:text-gray-300">No products found. Please check back later.</p>
                              </div>';
                    }

                    $conn->close();
                    ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    <nav class="flex items-center gap-1">
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-600 hover:text-white smooth-transition">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-600 text-white">
                            1
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-600 hover:text-white smooth-transition">
                            2
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-600 hover:text-white smooth-transition">
                            3
                        </button>
                        <span class="px-2">...</span>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-600 hover:text-white smooth-transition">
                            8
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-primary-600 hover:text-white smooth-transition">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </nav>
                </div>
            </main>
        </div>
    </div>

    <!-- Newsletter -->
    <section class="bg-primary-600 text-white py-12 mt-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-3">Subscribe to Our Newsletter</h2>
            <p class="mb-6 max-w-2xl mx-auto">Get the latest updates on new products and upcoming sales</p>
            <div class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto">
                <input type="email" placeholder="Your email address" 
                       class="flex-1 px-4 py-2 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                <button class="bg-white text-primary-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-100 smooth-transition">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="ph ph-shopping-bag"></i> ShopNest
                    </h3>
                    <p class="mb-4">Your one-stop shop for all your needs. Quality products at affordable prices.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white smooth-transition">
                            <i class="ph ph-facebook-logo text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white smooth-transition">
                            <i class="ph ph-twitter-logo text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white smooth-transition">
                            <i class="ph ph-instagram-logo text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white smooth-transition">
                            <i class="ph ph-linkedin-logo text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white smooth-transition">Home</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Shop</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Customer Service</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white smooth-transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Return Policy</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white smooth-transition">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2">
                            <i class="ph ph-map-pin"></i> 123 Street, City, Country
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ph ph-phone"></i> +123 456 7890
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ph ph-envelope"></i> info@shopnest.com
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ph ph-clock"></i> Mon-Fri: 9AM-6PM
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-6 border-t border-gray-700 text-center text-sm">
                <p>&copy; <?php echo date('Y'); ?> ShopNest. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Modal Functions
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Quantity Controls
        function incrementQuantity(button) {
            const input = button.parentElement.querySelector('input[type="number"]');
            input.value = parseInt(input.value) + 1;
        }
        
        function decrementQuantity(button) {
            const input = button.parentElement.querySelector('input[type="number"]');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Carousel Functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            currentSlide = index;
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }
        
        function goToSlide(index) {
            showSlide(index);
        }
        
        // Auto-rotate carousel
        setInterval(nextSlide, 5000);
        
        // Initialize first slide
        showSlide(0);
    </script>
</body>
</html>