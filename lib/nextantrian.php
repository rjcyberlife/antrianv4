<?php

require_once("panggilan.php");


if(isset($_GET["layanan"]))
{
    $jenislayanan = $_GET["layanan"];
    $layanan = new panggilan();
    
    echo $layanan->nextAntrian($jenislayanan); 
}


?>