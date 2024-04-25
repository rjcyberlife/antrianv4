<?php

require_once("panggilan.php");


    $layanan = new panggilan();
    
    $isExist = $layanan->isPanggilExist(); 

    if ($isExist==true){
        echo "true";
    } else
    echo "false";


?>