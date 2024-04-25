<?php

class database 
{
    
    
    public function __construct()
    {
        $host       = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "antrian";

        $conn = mysqli_connect($host,$username,$password,$dbname);

        if(!$conn){
            return mysqli_connect_error();
        }
        else
        return $conn;
    }
    
}

?>