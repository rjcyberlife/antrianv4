<?php

require_once("tiketlayanan.php");


if(isset($_GET["layanan"]))
{

    $jenislayanan = $_GET["layanan"];
    $layanan = new tiketlayanan();
    $layanan->insertAntrianBaru($jenislayanan);
   
    echo $layanan->getnomor($jenislayanan); 
}


?>