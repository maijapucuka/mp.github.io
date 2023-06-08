<?php

//start session and require all necessary files
session_start();
 
require_once '../models/DatabaseConnection.php';
require_once '../models/Product.php';

//create new DatabaseConnection instance and call function to connect to the database
$db = new DatabaseConnection();
$db_connection = $db->connect();

// create new Product class instance
$product = new Product ($db_connection);

//get all products from the database
$allProducts = $product->getAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="../assets/style/style.css">
    <script src="../assets/index.js" defer> </script>
</head>
<body>
    <div class="main-wrap">
        <h1 class="title">Product List</h1>
        <div class="wrap">
            <!-- form for deleting all checked products -->
            <form action="../controller/deleteProducts.php" method="POST">
                <div class="buttons">
                    <!-- button for adding a new product -->
                    <a href='addProduct.php' class="btn btn-primary" onclick="clearAll()">Add</a>
                    <!-- button for deleting for all checked products -->
                    <input type="submit" class="btn btn-primary" name="multiple-delete-product-btn" value="Mass delete" id="delete-product-btn">
                </div>
                
                <!-- display values for all the products that aren't deleted -->

                <div class="item-wrap">
                    <?php foreach ($allProducts as $product) {?>
                        <div class="item">
                            <!-- checkbox to delete the product -->
                            <input type="checkbox" class="delete-checkbox" name="prod_delete_sku[]" value="<?= $product["SKU"]; ?>">
                            <h2><?php echo $product["SKU"];?></h2>
                            <h2><?php echo $product["name"];?></h2>
                            <h2><?php echo $product["price"] . "$";?></h2>
                            <h2><?php echo $product["special"];?></h2>
                        </div>
                    <?php } ?>
                </div>
            </form>  
        </div>
    </div>
</body>
</html>