<?php
require_once('process/config.php'); // Connect to the database

// Fetch categories for dropdown
$categories = [];
$cat_result = mysqli_query($conn, "SELECT category_id, c_name FROM categories");
if ($cat_result && mysqli_num_rows($cat_result) > 0) {
    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories[] = $row;
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];
    $created_at = date('Y-m-d H:i:s');

    // Use static admin_id for now (replace with real admin later)
    $admin_id = 1;

    // Validate fields
    if (empty($name) || empty($category_id) || empty($price) || empty($quantity)) {
        echo "Please fill all the required fields.";
    } else {
        $filename = $image['name'];
        $filepath = $image['tmp_name'];
        $fileerror = $image['error'];
        $filesize = $image['size'];

        if ($fileerror == 0) {
            if ($filesize < 10485760) { // 10MB
                $new_filename = time() . "_" . $filename;
                $destination = "uploads/" . $new_filename;

                if (move_uploaded_file($filepath, $destination)) {
                    $sql = "INSERT INTO product (name, category_id, price, quantity, image, added_by, created_at) 
                            VALUES ('$name', '$category_id', '$price', '$quantity', '$new_filename', '$admin_id', '$created_at')";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        header("location:product.php");
                    } else {
                        echo "<p class='text-red-500'>Failed to insert product: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    echo "<p class='text-red-500'>Image upload failed.</p>";
                }
            } else {
                echo "<p class='text-red-500'>Image is too large. Max 10MB.</p>";
            }
        } else {
            echo "<p class='text-red-500'>Error with the uploaded file.</p>";
        }
    }
}
?>
