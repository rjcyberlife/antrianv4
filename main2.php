<?php

require_once("lib/tiketlayanan.php");
require_once("lib/panggilan.php");



$layanan = new tiketlayanan();
$panggil = new panggilan();

// function audio_list()
// {
// 	$output=array();
// 	$directory = 'audio/';
// 	$scanned_directory = array_diff(scandir($directory), array('..', '.'));
// 	foreach($scanned_directory as $r)
// 	{
// 		$ext=pathinfo($r,PATHINFO_EXTENSION);
// 		if(in_array($ext,array("MP3","mp3","wav")))
// 		{
// 			$explode=explode(".",$r);
// 			$ID=$explode[0];
// 			$output[]=array(
// 				'path'=>$directory.$r,
// 				'file'=>$r,
// 				'ID'=>$ID,
// 			);
// 		}
// 	}
// 	return $output;
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
 
  <link rel="apple-touch-iconx" sizes="76x76" href="assets/img/apple-icon.png">  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Antrian Imigrasi Pekanbaru
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/fungsi.js"></script>
  <script src="assets/js/voice.js"></script>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="assets/css/material-font.css" rel="stylesheet" />

    <style>
      .bg-table {
        background-image: linear-gradient(75deg,rgb(36, 156, 211), rgb(114, 23, 189));
    }
    </style>
  <script>
    
  
   $(function () {
 
    startTime();    
    setInterval(getNomorTerpanggil,1000);
    setInterval(getPanggilanSuara,1000);
    setInterval(lastpanggil,1000);
    refreshAt(07,00,0);
   
});



    </script>
</head>

<body class="mainbody" onload="videoload();">

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
           <img src="assets/img/logo-imigrasi.png" width="18%" height="18%">&nbsp;&nbsp;&nbsp;&nbsp;<p><b>KEMENTERIAN HUKUM DAN HAM RIAU <br><span style="font-size:25px">KANTOR IMIGRASI KELAS I TPI PEKANBARU</b></span></P>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <div style="font: size 50px;">
            <div id="txttanggal1"></div></span>
          </div>

        </div>
      </nav>
      <!-- End Navbar -->


      <div class="content" >
        <div class="container-fluid">
      
          
          <div class="row">
            <div class="col-md-6" >
              <div class="card card-chart bg-table">
                <!-- <div class="card-header card-header-success text-center ">                  
                                              
                  <h4><strong>NOMOR ANTRIAN</strong></h4>
                        
                </div> -->
                
                <div class="card-body text-center">
                
                <!-- <h1 style="font-size: 100px" ><strong>A 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>B 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>C 001</strong></h1>
                 -->
           
                 <table class="table">

                    <thead>
                      <tr>
                        <th scope="col" class="text-left" ><h2><strong>NO ANTRIAN</strong></h2></th>
                        <th scope="col"><h2><strong>LOKET</strong></h2></th>
                        
                      </tr>
                    </thead>

                      <tbody>

                        <tr class="blink_A">                        
                          <td class="text-left"><h1 style="font-size: 120px;text-shadow: 2px 2px  red;" ><strong><div id="txtnoA"></div></strong></h1></td>
                          <td><h1 style="font-size: 120px;text-shadow: 2px 2px 2px  red;" class="text-warning" ><strong><div id="txtloketA"></div></strong></h1></td>
                        </tr>


                        <tr class="blink_B">                        
                        <td class="text-left"><h1 style="font-size: 120px;text-shadow: 2px 2px  green;" ><strong><div id="txtnoB"></div></strong></h1></td>
                          <td><h1 style="font-size: 120px;text-shadow: 2px 2px  green;" class="text-warning" ><strong><div id="txtloketB"></div></strong></h1></td>
                        </tr>
                     
                      </tbody>
                </table>

                
                </div>
                
              
              </div>

              

            </div>
            



            <div class="col-md-6" >
              
            <div class="card card-chart bg-table">
                <!-- <div class="card-header card-header-success text-center ">                  
                                              
                  <h4><strong>NOMOR ANTRIAN</strong></h4>
                        
                </div> -->
                
                <div class="card-body text-center">
                
                <!-- <h1 style="font-size: 100px" ><strong>A 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>B 001</strong></h1>
                <h1 style="font-size: 100px" ><strong>C 001</strong></h1>
                 -->
           
                 <table class="table">

                    <thead>
                      <tr>
                        <th scope="col" class="text-left" ><h2><strong>NO ANTRIAN</strong></h2></th>
                        <th scope="col"><h2><strong>LOKET</strong></h2></th>
                        
                      </tr>
                    </thead>

                      <tbody>

                     
                        <tr class="blink_C">                        
                        <td class="text-left"><h1 style="font-size: 120px;text-shadow: 2px 2px  orange;" ><strong><div id="txtnoC"></div></strong></h1></td>
                          <td><h1 style="font-size: 120px;text-shadow: 2px 2px  orange;" class="text-warning" ><strong><div id="txtloketC"></div></strong></h1></td>
                        </tr>
                        <tr class="blink_F">                        
                        <td class="text-left"><h1 style="font-size: 120px;text-shadow: 2px 2px  orange;" ><strong><div id="txtnoF"></div></strong></h1></td>
                          <td><h1 style="font-size: 120px;text-shadow: 2px 2px  orange;" class="text-warning" ><strong><div id="txtloketF"></div></strong></h1></td>
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
              
              <div class="card-body>">
              <marquee behavior="scroll" direction="left" > 
                
              <h2> 
              SELAMAT DATANG DI KANTOR IMIGRASI KELAS I PEKANBARU  <img src="assets\img\logo.png" width="50px" height="50px"> 
              TARIF PENERIMAAN NEGARA BUKAN PAJAK (PNBP) DOKUMEN PERJALANAN REPUBLIK INDONESIA  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Paspor Biasa 48 Halaman Rp. 350.000 / permohonan  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Paspor biasa 48 halaman Elektronik Rp. 650.000 / permohonan  <img src="assets\img\logo.png" width="50px" height="50px"> 
              Layanan Percepatan Paspor Selesai Pada Hari yang Sama Rp. 1.000.000 / permohonan <img src="assets\img\logo.png" width="50px" height="50px"> 
              Biaya Beban Paspor Hilang Rp. 1.000.000 <img src="assets\img\logo.png" width="50px" height="50px"> 
              Biaya Beban Paspor Rusak Rp. 500.000 <img src="assets\img\logo.png" width="50px" height="50px"> 
              INFORMASI LEBIH LANJUT HUBUNGI CALL CENTER 081268216607 <img src="assets\img\logo.png" width="50px" height="50px"> 
              </h2>
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
   var video_list = ["video/profil.mp4","video/jingle.mp4","video/survey.mp4"];
   var videoindex = 0;
   var videoplayer = null;

   function videoload(){
     videoplayer = document.getElementById("mainvid");
     videoplayer.setAttribute("src",video_list[videoindex]);
     videoplayer.play();
   }

   function videoended() {
     
     if(videoindex<video_list.length-1) {
       videoindex++;
     }else {
       videoindex = 0;
     }

     videoplayer.setAttribute("src",video_list[videoindex]);
     videoplayer.play();
   }


  
</script>

</body>

</html>