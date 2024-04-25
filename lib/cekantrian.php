<?php

require_once("panggilan.php");




   // $jenislayanan = $_GET["layanan"];
    $layanan = new panggilan();
    $layanan->getTotalAntrian();
   
    echo $layanan->getTotalAntrian();


?>