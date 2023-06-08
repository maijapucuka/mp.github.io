<?php

//require all necessary files
require_once '../models/DatabaseConnection.php';
require_once '../models/ValidationFunctions.php';

//create new DatabaseConnection instance and call function to connect to the database
$db = new DatabaseConnection();
$db_connection = $db->connect();

//create new ValidationFunctions instance
$valFun = new ValidationFunctions();


//create an abstract ProductType class
abstract class ProductType {

    //define all the variables that will be used in the Type class
    private $SKU;
    private $name;
    private $price;
    private $product;
    private $paramSpecial;
    private $db_connection;

    //create the construct function for database connection
    public function __construct($db_connection) {
        
    }

    //create function for creating new product
    public function createNewProduct($paramSKU, $paramName, $paramPrice, $paramProduct, $paramSpecial) {

    }

    //create function for setting special param
    public function setSpecialParameter() {

    }

    //create function for returning special param
    public function getSpecialParameter() {

    }

    //create function for returning special param error
    public function getSpecialParameterError() {

    }

}

//create DVDProduct class
class DVDProduct extends ProductType {

    //define all the variables that will be used in the DVDProduct class
    private $size;
    private $db_connection;
    private $size_err;
    private $paramSpecial;

    //construct instance of the database connection
    public function __construct($db_connection) {
        $this->db_connection = $db_connection;
    }

    //function that gets size from form, validates and sets it as special param
    public function setSpecialParameter () {

        global $valFun;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paramSize = trim($_POST["size"]);
            $this->size_err = $valFun->validateSpecialParam($paramSize,"size_err");
            $paramSpecial = "Size: " . $paramSize . " MB";
            $this->paramSpecial = $paramSpecial;
        }
    }

    //return size error as special param error
    public function getSpecialParameterError() {
        return $this->size_err;
    }

    //if no size error return the special param
    public function getSpecialParameter() {
        if (empty($this->size_err)) {
            return $this->paramSpecial;
        }
    }

}

//create BookProduct class
class BookProduct extends ProductType{

    //define all the variables that will be used in the BookProduct class
    private $weight;
    private $weight_err;

    //construct instance of the database connection
    public function __construct($db_connection) {
        $this->db_connection = $db_connection;
    }

    //function that gets weight from form, validates and sets it as special param
    public function setSpecialParameter () {

        global $valFun;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paramWeight = trim($_POST["weight"]);
            $this->weight_err = $valFun->validateSpecialParam($paramWeight,"weight_err");
            $paramSpecial = "Weight: " . $paramWeight . "KG";
            $this->paramSpecial = $paramSpecial;
            } 
        }
    
    
    //return weight error as special param error
    public function getSpecialParameterError() {
        return $this->weight_err;
    }

    //if no weight error return the special param
    public function getSpecialParameter() {
        if (empty($weight_err)) {
            return $this->paramSpecial;
        }
    }
    
}

//create FurnitureProduct class
class FurnitureProduct extends ProductType{

    //define all the variables that will be used in the FurnitureProduct class
    private $height;
    private $width;
    private $length;
    private $height_err;
    private $width_err;
    private $length_err;

    //construct instance of the database connection
    public function __construct($db_connection) {
        $this->db_connection = $db_connection;
    }

    //function that gets width, height and length from form, validates and sets them as special param
    public function setSpecialParameter () {

        global $valFun;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $paramHeight = trim($_POST["height"]);
            $paramWidth = trim($_POST["width"]);
            $paramLength = trim($_POST["length"]);

            $this->height_err = $valFun->validateSpecialParam($paramHeight,"height_err");
            $this->width_err = $valFun->validateSpecialParam($paramWidth,"width_err");
            $this->length_err = $valFun->validateSpecialParam($paramLength,"length_err");
        
            $paramSpecial = "Dimension: " . $paramHeight . "x" . $paramWidth . "x" . $paramLength;
            $this->paramSpecial = $paramSpecial;
        }
    }

    //return size error as special param error
    public function getSpecialParameterError() {
        $errors = array(
        "height_err" => $this->height_err,
        "width_err" => $this->width_err,
        "length_err" => $this->length_err,
        );
        return $errors;
    }

    //if no height, width and length errors return the special param
    public function getSpecialParameter() {
        if (empty($this->height_err) && empty($this->width_err) && empty($this->length_err)) {
            return $this->paramSpecial;
        }
    }

}


?>