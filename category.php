<?php
require_once('process/config.php'); // Connect to the database
require ('process/success.php'); // Success messages
require ('process/errors.php');
if (isset($_POST['add_category'])) {
    // Get the category name from the form input
    $category_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $checkCategory = mysqli_query($conn, "SELECT c_name FROM categories WHERE c_name = '$category_name'") or die (mysqli_error($conn));
    if (mysqli_num_rows($checkCategory) > 0){
        $dataExist = "Your Category";
        $redirection = "product.php";
        already_exist($dataExist,$redirection);
    }
    else{
    // Prepare the SQL query
    $addCategory =mysqli_query($conn, "INSERT INTO categories (c_name) VALUES ('$category_name')") or die (mysqli_error($conn));

    // Execute the query
    if ( $addCategory == true) {
        // Redirect to product.php
        addNewCategory();
        echo '<script>location.href="product.php"</script>';
        exit(); // Always call exit after header redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
}

// Close the connection
mysqli_close($conn);
?>
