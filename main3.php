<?php

require_once("lib/tiketlayanan.php");
require_once("lib/panggilan.php");



$layanan = new tiketlayanan();
$panggil = new panggilan();

$url = "";

if (isset($_GET['id']))
{

  $id = $_GET['id'];
  $prefix = $_GET['prefix'];
  $no = $_GET['no'];


  $fullno = $prefix." - ".sprintf("%03s", $no);

  //munculkan antrian sesuai kategori

  $txtno = "txtno".$prefix;
  $txtloket = "txtloket".$prefix;
 
} else {

  $id = '';
  $prefix = "-";
  $no = '';
  $fullno = $prefix;
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
 
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Antrian Imigrasi Pekanbaru
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  
  <link rel="stylesheet" href="<?=$url?>assets/css/font-awesome.min.css">
  <script src="<?=$url?>assets/js/core/jquery.min.js"></script>
  <script src="<?=$url?>assets/js/fungsi.js"></script>
  <script src="<?=$url?>assets/js/voice.js"></script>
  <!-- CSS Files -->
  <link href="<?=$url?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="<?=$url?>assets/css/material-font.css" rel="stylesheet" />

    <style>
      .bg-table {
        background-image: linear-gradient(75deg,rgb(36, 156, 211), rgb(114, 23, 189));
    }
    </style>
 
</head>

<body class="mainbody">

    <?php
      // $list=audio_list();
      // if(!empty($list))
      // {
      //   foreach($list as $a)
      //   {
      //     //echo '<audio id="audio'.$a['ID'].'"  src="'.$a['path'].'"></audio>'."\n";
      //   }
      // }

     
    ?>

  <div class="wrapper ">
    
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-primary bg-transparent navbar-absolute fixed-top  ">
        <div class="container-fluid ">
          <div class="navbar-wrapper ">
           <img src="assets/img/logo-imigrasi.png" width="18%" height="18%"><br>&nbsp;&nbsp;&nbsp;&nbsp;<p>Kementerian Hukum dan HAM Riau <br><b><span >Kantor Imigrasi Kelas I TPI Pekanbaru</b></span></P>
           
          </div>
          <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>-->
          <div class="collapse navbar-collapse justify-content-end">
            <div style="font: ">
            
          </div>

        </div>
      </nav>
      <!-- End Navbar -->


      <div class="content" >
        <div class="container-fluid">
      
          
          <div class="row">
            <div class="col-md-12" >
              <div class="card card-chart bg-table">
                <!-- <div class="card-header card-header-success text-center ">                  
                                              
                  <h4><strong>NOMOR ANTRIAN</strong></h4>
                        
                </div> -->
                
                <div class="card-body text-center">

                <div id="prefixLive" class="d-none"><?=$prefix?></div>
                <div id="noLive" class="d-none"><?=$no?></div>
                <div id="IDLive" class="d-none"><?=$id?></div>

                <!-- <h1 style="font-size: 100px" ><strong>A 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>B 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>C 001</strong></h1>
                 -->
           
                 <table class="table">

                    <thead>
                      <tr>
                        <th scope="col" class="text-left" ><h4><strong>NO ANTRIAN SAAT INI</strong></h4></th>
                        <th scope="col"><h4><strong>LOKET</strong></h4></th>
                        
                      </tr>
                    </thead>

                      <tbody>

                        <tr>
                          <td class="text-left"><h1 style="font-size: 40px;text-shadow: 2px 2px  red;" ><strong><div id="<?=$txtno?>"></div></strong></h1></td>
                          <td><h1 style="font-size: 40px;text-shadow: 2px 2px 2px  red;" class="text-warning" ><strong><div id="<?=$txtloket?>"></div></strong></h1></td>
                        </tr>
                        <tr >
                          <td class="text-left">
                          <h5>NO ANTRIAN ANDA</h5>                            
                          
                          <span id="txtsisaantrianloket"></span>
                          </td>
                          
                          <td class="text-left"><strong>
                          <h5>: <?=$fullno?></h5>  
                          <h5>: <span id="txtsisalive"></span></h5></strong>
                          </td>
                          
                        </tr>
                        
                        </tr>
                        
                      </tbody>
                </table>
                
                </div>
                
              
              </div>

              

            </div>
            



         

            

          </div>
         


          <!-- Marquee -->

          <div class="row">
            <div class="col-md-12">

              <div class="card card-chart ">
              
              <div class="card-bodsy">
              <marquee behavior="scroll" direction="left" > 
                
              <h3> 
              SELAMAT DATANG DI KANTOR IMIGRASI KELAS I PEKANBARU  <img src="assets\img\logo.png" width="50px" height="50px"> 
              TARIF PENERIMAAN NEGARA BUKAN PAJAK (PNBP) DOKUMEN PERJALANAN REPUBLIK INDONESIA  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Paspor Biasa 48 Halaman Rp. 350.000 / permohonan  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Paspor biasa 48 halaman Elektronik Rp. 650.000 / permohonan  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Layanan Percepatan Paspor Selesai Pada Hari yang Sama Rp. 1.000.000 / permohonan <img src="assets\img\logo.png" width="50px" height="50px"> 
              Biaya Beban Paspor Hilang Rp. 1.000.000 <img src="assets\img\logo.png" width="50px" height="50px"> 
              Biaya Beban Paspor Rusak Rp. 500.000 <img src="assets\img\logo.png" width="50px" height="50px"> 
              INFORMASI LEBIH LANJUT HUBUNGI CALL CENTER 081268216607 <img src="assets\img\logo.png" width="50px" height="50px"> 
              </h3>
              </marquee>
              
              </div>
              </div>

            </div>
          </div>
          <!-- End Marquee  -->

        </div>
        
      </div>
 
    </div>
  </div>
  
  <script>
    
  
   $(function () {
 
    startTime();    
    setInterval(getNomorTerpanggil,1000);
    setInterval(getTotalAntrian,1000);
    refreshAt(07,00,0);
   
});



    </script>

</body>


</html>