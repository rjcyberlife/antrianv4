<?php

require_once("lib/tiketlayanan.php");
require_once("lib/panggilan.php");


$layanan = new tiketlayanan();
$panggil = new panggilan();

// if($panggil->getClientMAC())
// {
//   header('Location: panggil.php');
//   exit;
// }


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
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/fungsi.js"></script>  
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="assets/css/material-font.css" rel="stylesheet" />
  <script>
   
    </script>
</head>

<body onload="startTime();">
  <div class="wrapper ">
    
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-success navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
           <img src="assets/img/logo-imigrasi.png" width="15%" height="15%"><a class="navbar-brand" href="javascript:;">Kantor Imigrasi Kelas I TPI Pekanbaru</a>
          </div>

          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        
        </div>
      </nav>
      <!-- End Navbar -->


      <div class="content" >
        <div class="container-fluid">
      
          
          <div class="row">
            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-danger">                  
                    <h4>ONLINE</h4>                             
                                     
                </div>
                <div class="card-body">
                  <button class="btn btn-primary btn-block" style="height:100px" onclick="cetaknomor('A')">
                 <h2><strong> <div id="sectionA"><?= $layanan->getnomor("A");?></div></strong></h2> </button>
                  
                </div>
                <div class="card-footer">
                     
                  
                </div>
              
              </div>
            </div>
            <div class="col-md-3" >
              <div class="card card-chart">
                <div class="card-header card-header-success">
                                  
                    <h4><i class="material-icons"> </i> LANSIA</h4>                 
              
               
                </div>
                <div class="card-body">
                  <button class="btn btn-primary btn-block" style="height:100px" onclick="cetaknomor('B')">
                  <h2><strong> <div id="sectionB"><?= $layanan->getnomor("B");?></div></strong></h2> </button>
                </div>
                <div class="card-footer">
                  
                  
                </div>
               
              </div>
            </div>

            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                
                    <h4>BAP</h4>                 
                    
                </div>
                <div class="card-body">
                  <button class="btn btn-primary btn-block" style="height:100px" onclick="cetaknomor('C')">
                  <h2><strong> <div id="sectionC"><?= $layanan->getnomor("C");?></div></strong></h2> </button>
                </div>
                <div class="card-footer">
                      
                  
                </div>
               
              </div>
            </div>


            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-info">
                
                    <h4>PERCEPATAN</h4>                 
                    
                </div>
                <div class="card-body">
                  <button class="btn btn-primary btn-block" style="height:100px" onclick="cetaknomor('F')">
                  <h2><strong> <div id="sectionF"><?= $layanan->getnomor("F");?></div></strong></h2> </button>
                </div>
                <div class="card-footer">
                      
                  
                </div>
               
              </div>
            </div>

          </div>
         

           <div class="row">

            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="card card-chart">
               
                <div class="card-body text-center">
                  <h2 class="text-success"><b>CUSTOMER SERVICE</b></h2>
                  <div id="txt"></div>
                  
                </div>
              
              </div>
            </div>

            <div class="col-md-4"></div>
          </div>


        </div>
      </div>
 
    </div>
  </div>
  
  <div id="print" style="display:none;">
    <img src="assets/img/logo.png" width="10%" height="10%">
    <p>KANTOR IMIGRASI <br/>KELAS I TPI PEKANBARU<br/>
    Jl. Teratai No.87</p>
    <p style="font-size:18px">NOMOR ANTRIAN ANDA :
    <div id="textantrian" style="font-size:32px;"></div>
    <div id="txttanggal"></div>
    </p>

</div>
  



</body>

</html>