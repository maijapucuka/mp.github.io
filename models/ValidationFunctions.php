<?php

//create the ValidationFunctions class
class ValidationFunctions {

    //define all the variables that will be used in ValidationFunctions class
    public $paramSKU;
    private $paramName;
    private $paramPrice;
    private $paramProduct;
    private $paramToBeValidated;
    private $paramErrorType;

    public $SKU_err;
    private $name_err;
    private $price_err;
    private $product_err;


    // create function that validates the SKU param
    public function validateSKU($paramSKU) {

        $this->paramSKU = $paramSKU;

        //check if SKU param is empty, if yes return an error messege
        if(empty($this->paramSKU)) {
            $this->SKU_err = "Please, submit required data!";
        
        //check if SKU param is too long, if yes return an error messege
        } else if (strlen($this->paramSKU) > 50) {
            $this->SKU_err = "Your SKU is too long!";

        //if all previous errors are false, return SKU error as empty
        } else {
            $this->SKU_err = FALSE;
        }
        return $this->SKU_err;

    }


    // create function that validates the name param
    public function validateName($paramName) {

        $this->paramName = $paramName;

        //check if name param is empty, if yes return an error messege
        if(empty($this->paramName)) {
            $this->name_err = "Please, submit required data!";
        
        //check if name param is too long, if yes return an error messege
        } else if (strlen($this->paramName) > 150) {
            $this->name_err = "Your product name is too long!";
        
        //check if name param isn't string, if true return an error messege
        } else if (!is_string($this->paramName)) {
            $this->name_err = "Please, provide the data of indicated type";

        //if all previous errors are false, return name error as empty
        } else {
            $this->name_err = FALSE;
        }
        return $this->name_err;

    }


    // create function that validates the price param
    public function validatePrice($paramPrice) {

        $this->paramPrice = $paramPrice;

        //check if price param is empty, if yes return an error messege
        if(empty($this->paramPrice)) {
            $this->price_err = "Please, submit required data!";
        
        //check if price param is too long, if yes return an error messege
        } else if (strlen($this->paramPrice) > 50) {
            $this->price_err = "Your product price input is too long!";
        
        //check if price param isn't numeric, if true return an error messege
        } else if (!is_numeric($this->paramPrice)) {
            $this->price_err = "Please, provide the data of indicated type";

        //if all previous errors are false, return price error as empty
        } else {
            $this->price_err = FALSE;
        }
        return $this->price_err;

    }


    // create function that validates the product param
    public function validateProduct($paramProduct) {

        $this->paramProduct = $paramProduct;

        //check if product param is empty, if yes return an error messege
        if(empty($this->paramProduct)) {
            $this->product_err = "Please, submit required data!";
        
        //check if product param is too long, if yes return an error messege
        } else if (strlen($this->paramProduct) > 50) {
            $this->product_err = "Your product type input is too long!";
        
        //if all previous errors are false, return product error as empty
        } else {
            $this->product_err = FALSE;
        }
        return $this->product_err;

    }


     // create function that validates all the special params
    public function validateSpecialParam($paramToBeValidated, $paramErrorType) {

        $this->paramToBeValidated = $paramToBeValidated;
        $this->paramErrorType = $paramErrorType;

        //check if special param is empty, if yes return an error messege
        if(empty($this->paramToBeValidated)) {
            $this->paramErrorType = "Please, submit required data!";
        
        //check if special param is too long, if yes return an error messege
        } else if (strlen($this->paramToBeValidated) > 50) {
            $this->paramErrorType = "Your parameter input is too long!";
        
        //check if special param isn't numeric, if true return an error messege
        } else if (!is_numeric($this->paramToBeValidated)) {
            $this->paramErrorType = "Please, provide the data of indicated type";

        //if all previous errors are false, return special param error as empty
        } else {
            $this->paramErrorType = FALSE;
        }
        return $this->paramErrorType;

    }

}


?>