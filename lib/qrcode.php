<?php
    require_once("tiketlayanan.php");
    require_once("panggilan.php");
    require_once("phpqrcode/qrlib.php");

    $layanan = new tiketlayanan();

  
    //$isi = 'http://0.tcp.ap.ngrok.io:10046/antrian/main2.php?id=1&hasha=1'; 
    QRcode::png($isi,'qr.png',QR_ECLEVEL_L, 4, 5); 
    echo '<img src="qr.png">';
    ?>