<?php

//start session and require all necessary files
session_start();

require_once '../models/DatabaseConnection.php';
require_once "../models/Product.php";

//create new DatabaseConnection instance and call function to connect to the database
$db = new DatabaseConnection();
$db_connection = $db->connect();

if(isset($_POST['multiple-delete-product-btn'])) {
    $all_SKU = $_POST['prod_delete_sku']; //return an array of all SKU for the products to be mass deleted
    $deletedProductsSKU = implode(',', $all_SKU); //turn the array of all SKU for the products to be mass deleted in a string

    // create new Product class instance and call function to delete checked products
    $product = new Product($db_connection);
    $product->deleteProduct($deletedProductsSKU);
}



?>