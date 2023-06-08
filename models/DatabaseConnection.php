<?php

//create DatabaseConnection class
class DatabaseConnection {

    //define all the variables that are needed to connect to database will be used in Product class
    private $host = "localhost";
    private $root = "root";
    private $password = "";
    private $database = "sw_test";

    //set connection variable to null
    public $con = null;

    //create function that uses defined variables to connect to the database
    public function connect() {
        $this->con = mysqli_connect($this->host,$this->root,$this->password,$this->database);

        //if connection fails echo an error, else return connection variable
        if ($this->con == FALSE) {
            die("Something went wrong! Could not connect to database! Please try again!");
        } else {
            return $this->con;
        }
        
    }

}



?>