<?php
//header("Content-type:application/pdf");

?>
<html>

<head>
	<meta http-equiv="content-type" content="application/pdf; charset=iso-8859-1">
	<meta name="author" content="sweethome">
<!--     Fonts and icons     -->
<script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/fungsi.js"></script>  
  <!-- <link rel="stylesheet" href="assets/css/font-awesome.min.css"> -->

  <!-- CSS Files -->
  <!-- <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="../assets/css/material-font.css" rel="stylesheet" /> -->
	<title>Tiket Antrian</title>
	

  <script type="text/javascript">

  
$(function () {
 
 startTime();
});

	function printThenClose() {
		
		
  try
  {
      //Try to print using jsPrintSetup Plug-In in Firefox
      //If it is not installed fall back to default printing
      
      
      jsPrintSetup.setPrinter('Tiket');
      //jsPrintSetup.setPrinter('doPDF v7');
      jsPrintSetup.clearSilentPrint();   
      jsPrintSetup.setOption('printSilent', 1);
      
      jsPrintSetup.setOption('marginTop', 1);
      jsPrintSetup.setOption('marginBottom', 2);
      jsPrintSetup.setOption('marginLeft', 2);
      jsPrintSetup.setOption('marginRight', 2);

      //Choose printer using one or more of the following functions
      //jsPrintSetup.getPrintersList...
      //jsPrintSetup.setPrinter...
      //jsPrintSetup.setPaperSizeUnit(jsPrintSetup.kPaperSizeMillimeters);
            //jsPrintSetup.setOption('paperHeight', 127);
            //jsPrintSetup.setOption('paperWidth', 101);


      //Set Header and footer...
      jsPrintSetup.setOption('headerStrLeft','' );
      jsPrintSetup.setOption('headerStrCenter','' );
	    jsPrintSetup.setOption('headerStrRight','' );
      jsPrintSetup.setOption('footerStrLeft','' );
      jsPrintSetup.setOption('footerStrCenter','' );
      jsPrintSetup.setOption('footerStrRight','' );
	  
	    jsPrintSetup.setOption('numCopies', 1);   
	    jsPrintSetup.printWindow(window);
      jsPrintSetup.print();     
      window.close();
  }
  catch(err)
  {   
      //Default printing if jsPrintsetup is not available
      window.print();
      window.close();
  }

}
	</script>

</head>



<body onload="printThenClose();startTime();">
<?php

if(!isset($_GET['layanan']))
exit;

?>

<center>
  
  <?php
    require_once("tiketlayanan.php");
    require_once("panggilan.php");
    require_once("phpqrcode/qrlib.php");

    $layanan = new tiketlayanan();
    $panggilan = new panggilan();

    $lastid = json_decode($panggilan->getTotalAntrian(),true);
    $prefix = $_GET['layanan'];



    $isi = 'https://antrian.kanimpekanbaru.id/main3.php?id='.$lastid['id'].'&prefix='.$prefix.'&no='.$lastid[$prefix]; 

  
 
    ?>
<div id="print">
  <!-- <img src="../assets/img/logo.png" width="50px" height="50px"> -->
  <p style="font-size:12px">KANTOR IMIGRASI <br/>KELAS I TPI PEKANBARU</br>
  Jl. Teratai No.87</p>
  <p style="font-size:13px">NOMOR ANTRIAN ANDA : 
    <div id="textantrian" style="font-size:38px;"><?=$layanan->getnomor($_GET['layanan']);?></div>
    
    <div style="font-size:13px">SCAN QR UNTUK CEK<br> ANTRIAN SAAT INI</div>
    <?php require_once("qrcode.php");?>
    <div id="txttanggal"></div>
    </p>

</div>
</center>
</body>
</html>

<?php
exit();
?>