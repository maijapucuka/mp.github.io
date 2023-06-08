<?php

    //start session and require all necessary files
    session_start();

    require_once '../models/DatabaseConnection.php';
    require_once '../models/ValidationFunctions.php';
    require_once '../models/ProductType.php';
    require_once '../models/Product.php';

    //create new DatabaseConnection instance and call function to connect to the database
    $db = new DatabaseConnection();
    $db_connection = $db->connect();

    //create new ValidationFunctions instance
    $valFun = new ValidationFunctions();
    
    //define all the variables for form fields and their respective errors
    $paramSKU = $paramName = $paramPrice = $paramProductType = $paramSize = $paramWeight = $paramHeight = $paramWidth = $paramLength = "";
    $SKU_err = $name_err = $price_err = $product_err = $size_err = $weight_err = $height_err = $width_err = $length_err = $specialParameterError = "";


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $product = new Product($db_connection); //create new Product instance
        $product->setParams(); //call the function that will set and validate params from the form
        $selectedProductType = $product->getProduct();  //get the product type user has chosen

        //get errors for the form params
        $SKU_err = $product->getSKUerror();
        $invalidSKUerror = $product->validateSKU();
        $name_err = $product->getNameError();
        $price_err = $product->getPriceError();
        $product_err = $product->getProductError();

        //get params from the form
        $paramSKU = $product->getSKU();
        $paramName = $product->getName();
        $paramPrice = $product->getPrice();
        $paramProductType = $product->getProduct();

        //define all the product types that can be chosen by the user as an array
        $productTypes = array('DVDProduct'=>'DVD', 'BookProduct'=>'book', 'FurnitureProduct'=>'furniture');

            //check if the product type user has selected is between the offered product types
            if(in_array($selectedProductType, $productTypes)) {
                $productTypeName = array_search($selectedProductType, $productTypes); //if previous true, select the product type user has chosen
                $productType = new $productTypeName($db_connection); //create new class of the product type user has chosen

                $productType->setSpecialParameter(); //call the function that will set and validate special param

                $specialParameterError = $productType->getSpecialParameterError(); //return the special param error
                $product->setSpecialParamError($specialParameterError); //set special param error for Product class
                $paramSpecial = $productType->getSpecialParameter(); //return the special param value
                $product->setSpecialParam($paramSpecial); //set special param value for Product class

                $product->createNewProduct(); //call the function to create a new product
                  
            } 
       
    }
      
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <script src="../assets/addProduct.js" defer> </script>
</head>
<body>
    <div class="body">
        <div class="nav-wrap">
            <h1 class="title">Product Add</h1>
            <div class="buttons">
                <a href="index.php" class="btn" onclick="clearAll()">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="form" id="product_formWrap">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="product_form" onsubmit="submitForm()">
                
                <!-- if SKU entry isn't valid, display an error messege -->
                <?php
                if (!empty($SKU_err)) {
                    echo '<div class="alert alert-danger">' . $SKU_err . '</div>';
                }
                if (!empty($invalidSKUerror)) {
                    echo '<div class="alert alert-danger">' . $invalidSKUerror . '</div>';
                } ?>

                <!-- SKU label and input field -->
                <label for="SKU">SKU</label>
                <input type="text" id="SKU" name="SKU" value=<?php echo $paramSKU;?>><br>

                <!-- if name entry isn't valid, display an error messege -->
                <?php 
                if (!empty($name_err)) {
                    echo '<div class="alert alert-danger">' . $name_err . '</div>';
                } ?>

                <!-- name label and input field -->
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value=<?php echo $paramName;?>><br>

                <!-- if price entry isn't valid, display an error messege -->
                <?php
                if (!empty($price_err)) {
                    echo '<div class="alert alert-danger">' . $price_err . '</div>';
                } ?>

                <!-- price label and input field -->
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" value=<?php echo $paramPrice;?>><br>

                <!-- if product entry isn't valid, display an error messege -->
                <?php 
                if (!empty($product_err)) {
                    echo '<div class="alert alert-danger">' . $product_err . '</div>';
                } ?>

                <!-- product type switcher -->
                <label>
                    Type Switcher
                    <select name="productType" id="productType">
                        <option value="" >Choose your product type</option>
                        <option value="DVD" id="DVD" data-target="DVD_attributes">DVD</option>
                        <option value="book" id="Book" data-target="book_attributes">Book</option>
                        <option value="furniture" id="Furniture" data-target="furniture_attributes">Furniture</option>
                    </select>
                </label>

                <!-- hidden special param labels and input fields -->
                <div id="fields">
                    <div id="DVD_attributes" class="hidden">
                        <p>Please, provide size of the DVD</p>
                        <label>Size (MB)</label>
                        <input type="text" name="size" id="size">
                    </div>
                    <div id="book_attributes" class="hidden">
                        <p>Please, provide weight of the book</p>
                        <label>Weight (KG)</label>
                        <input type="text" name="weight" id="weight">
                    </div>
                    <div id="furniture_attributes" class="hidden">
                        <p>Please, provide dimensions of the furniture in HxWxL format</p>
                        <label>Height (CM)</label>
                        <input type="text" name="height" id="height"><br>
                        <label>Width (CM)</label>
                        <input type="text" name="width" id="width"><br>
                        <label>Length (CM)</label>
                        <input type="text" name="length" id="length"><br>
                    </div>
                </div>

                <!-- if special param entry isn't valid, display an error messege -->
                <?php
                if (!empty($specialParameterError)) {
                    if (is_array($specialParameterError)) {
                        foreach ($specialParameterError as $key => $value) { //if any of special param errors aren't false display an error messege
                            if ($value !== false) {
                                echo '<div class="alert alert-danger">' . $value . '</div>';
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger">' . $specialParameterError . '</div>';
                    }    
                }
                ?>

                <!-- submit button -->
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>