<?php

require_once("panggilan.php");


if(isset($_POST["suara"]) && isset($_POST["idloket"]))
{
    $suara = $_POST["suara"];
    $loket = $_POST["idloket"];
    
    $obj = new panggilan();
    
    $obj->updateSuara($loket,$suara); 
}


?>