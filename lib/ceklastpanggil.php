<?php

require_once("panggilan.php");

    $cat = $_GET["cat"];    
    $layanan = new panggilan();

    if($cat==1){ //cari last by max id

        echo $layanan->getLastPanggil();
    } elseif($cat==2){ //cari nomor loket yang sudah terpanggil

        $tanggal = $_GET['_tanggal'];
        $prefix = $_GET['_prefix'];
        $no = $_GET['_no'];

        echo $layanan->getNoLoketTerpanggil($tanggal,$prefix,$no);
    }       


?>