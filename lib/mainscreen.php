<?php

require_once("panggilan.php");
require_once("tiketlayanan.php");

   // $jenislayanan = $_GET["layanan"];
    $layanan = new panggilan();
    $tiket = new tiketlayanan();
  
   
    $tiket->insertToday();

    if (isset($_GET['delete'])){
        
        if($_GET['delete']=="true" && $_GET['id']<>"") {
            $layanan->deletePanggilTemp($_GET['id']);
            echo "OK";
        }

    } else {
            echo $layanan->getPanggilTemp();
    }


?>
