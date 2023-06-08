<?php

//require all necessary files
require_once '../models/DatabaseConnection.php';
require_once 'ValidationFunctions.php';

//create new DatabaseConnection instance and call function to connect to the database
$db = new DatabaseConnection();
$db_connection = $db->connect();

//create new ValidationFunctions instance
$valFun = new ValidationFunctions();


//create the Product class
class Product {

    //define all the variables that will be used in Product class
    private $SKU;
    private $name;
    private $price;
    private $product;
    private $paramSpecial;

    private $is_deleted;
    private $db_connection;

    private $SKU_err;
    private $name_err;
    private $price_err;
    private $product_err;
    private $invalidSKU_err;

    //create the construct function for database connection
    public function __construct($db_connection) {
        $this->db_connection = $db_connection;
    }

    // create function that will set all the params from the form
    public function setParams() {

        global $valFun;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get the SKU param from the form and validate it
            $paramSKU = trim($_POST["SKU"]);
            $this->SKU_err = $valFun->validateSKU($paramSKU);
            $this->SKU = $paramSKU;

            //get the name param from the form and validate it
            $paramName = trim($_POST["name"]);
            $this->name_err = $valFun->validateName($paramName);
            $this->name = $paramName;

            //get the price param from the form and validate it
            $paramPrice = trim($_POST["price"]);
            $this->price_err = $valFun->validatePrice($paramPrice);
            $this->price = $paramPrice;

            //get the product param from the form and validate it
            $paramProduct = trim($_POST["productType"]);
            $this->product_err = $valFun->validateProduct($paramProduct);
            $this->product = $paramProduct;
        }
    }

    //create a SKU validation function that will check if the SKU that the user has created has not been used before
    public function validateSKU() {

        // create the sql statement and initiate it
        $sql = "SELECT SKU FROM products WHERE SKU = ?";
            $stmt = $this->db_connection->stmt_init();

            //prepare the sql statement and bind the SKU param that will be checked
            if ($stmt->prepare($sql)) {
                $stmt->bind_param("s", $param_SKUverif);

                $param_SKUverif = $this->SKU;
            
            //execute the sql statement and store the result
            if ($stmt->execute()) {
                $stmt->store_result();

                //if the result is not empty and the SKU has already been used before return an error messege
                if ($stmt->num_rows == 1) {
                    $this->invalidSKU_err = "Sorry this SKU already exists! Please chose a different one.";
                    return $this->invalidSKU_err;
                
                // if the result is empty return the error as FALSE
                } else {
                    $paramSKU = $param_SKUverif;
                    return $this->invalidSKU_err = FALSE;
                }
            } 

        //close the sql statement
        } $stmt->close();
    }

    //create a function that sets the special param
    public function setSpecialParam($paramSpecial) {
        $this->paramSpecial = $paramSpecial;
    }

    //create a function that sets the special params error
    public function setSpecialParamError($specialParameterError) {
        if (is_array($specialParameterError)) {
            $errorValues = array_values($specialParameterError); //get all specialParameterError array values
            if (in_array(!false, $errorValues)) { //check if any of the special param errors isn't false
                $this->paramSpecialError = !empty($specialParameterError); //if any of the special param errors isn't false return not empty
            } else {
                $this->paramSpecialError = FALSE; //if all special param errors are empty return FALSE
            }
        } else {
            $this->paramSpecialError = $specialParameterError;
        }
    }
    
    // create get functions for all variables from the form
    public function getSKU() {
        return $this->SKU;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getProduct() {
        return $this->product;
    }

    // create get functions for all errors for variables from the form
    public function getSKUerror() {
        return $this->SKU_err;
    }

    public function getNameError() {
        return $this->name_err;
    }

    public function getPriceError() {
        return $this->price_err;
    }

    public function getProductError() {
        return $this->product_err;
    }

    // create function for adding a new products
    public function createNewProduct() {
        
        //make sure all the error variables are empty
        if(empty($this->SKU_err) && empty($this->invalidSKU_err) && empty($this->name_err) && empty($this->price_err) && empty($this->product_err) && empty($this->paramSpecialError)) {

            //create sql statement for inserting the new product in database and initiate it
            $sql = "INSERT INTO products (SKU, name, price, product, special) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db_connection->stmt_init();
            
            //prepare the sql statement
            if($stmt->prepare($sql)) {

                //bind all the params that will be inserted into the database
                $stmt->bind_param("ssiss", $paramDB_SKU, $paramDB_name, $paramDB_price, $paramDB_product, $paramDB_special);
                $paramDB_SKU= $this->SKU;
                $paramDB_name = $this->name;
                $paramDB_price = $this->price;
                $paramDB_product = $this->product;
                $paramDB_special = $this->paramSpecial;
        
                    //execute the statement and if data succesfully added to database redirect to main page
                    if($stmt->execute()) {
                        header("location: ../view/index.php");
                    }

                //close the sql statement
                $stmt->close();
            }
        }
    }

    // create get function for invalid SKU error (if this SKU already exists in db)
    public function getInvalidSKUerror() {
        return $this->invalidSKU_err;
    }


    //create function that will get all the created products that aren't deleted from the database
    public function getAll() {

        //create the sql statement for getting all the products from db and initiate it
        $sql = "SELECT * FROM products WHERE NOT is_deleted";
        $stmt = $this->db_connection->stmt_init();

        //prepare the sql statement
        if ($stmt->prepare($sql)) {
            
            //execute the statement and return all the products from db
            if ($stmt->execute()) {
                $allProducts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                return $allProducts;  
            } else {
                return FALSE;
            }
        
        //close the sql statement
        }$stmt->close();
    }

   
   
    //create function for deleting all the checked products from the index page
    public function deleteProduct($deletedProductsSKU) {
        $this->deletedProducts = $deletedProductsSKU;

        //create the sql statement for deleting all the checked products and initiate it
        $sql = "UPDATE products SET is_deleted = 1 WHERE SKU IN(" . $this->deletedProducts . ")";
        $stmt = $this->db_connection->stmt_init();

        //prepare the sql statement
        if ($stmt->prepare($sql)) {

            //execute the statement and if data succesfully added to database redirect to main page
            if ($stmt->execute()) {
                header("location: ../view/index.php");
            } else echo "not ok";

        //close the sql statement
        } $stmt->close();
    
    }

}


?>