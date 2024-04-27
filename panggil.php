<?php
require_once("lib/panggilan.php");


$panggil = new panggilan();

if(!$panggil->getClientMAC())
{
 //header('Location: index.php');
 exit;
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
 
 <link rel="stylesheet" href="assets/css/font-awesome.min.css">
 <script src="assets/js/core/jquery.min.js"></script>
 <script src="assets/js/core/bootstrap-material-design.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
 <script src="assets/js/fungsi.js"></script>
 <!-- CSS Files -->
 <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
 <link href="assets/css/material-font.css" rel="stylesheet" />
 
 <script>
  getTotalAntrian();
  setInterval(getTotalAntrian  , 5000);
  setInterval(function() {
    $('#nopanggilanA').load(document.URL +  ' #nopanggilanA');
    $('#nopanggilanB').load(document.URL +  ' #nopanggilanB');
    $('#nopanggilanC').load(document.URL +  ' #nopanggilanC');
    
  }, 60000);


  $(document).ready(function(){
    
    $("input:radio").click(function(){
      var data = $("#voice").serialize();
     
      // console.log(data);
      $.ajax (
        {
          type  : "POST",
          url : "lib/suara.php",
          data : data,
          cache :false,
          success : function(data){
            
          }
        }
      )

    }

    )
  })
  
 
</script>

</head>

<body class="" onload="startTime();">
  <div class="wrapper ">
    
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-success navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
           <img src="assets/img/logo-imigrasi.png" width="15%" height="15%"><a class="navbar-brand" href="javascript:;"><strong>Kantor Imigrasi Kelas I TPI Pekanbaru</strong></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <div >
          <form id="voice" name="frmvoice" action="" method="POST">
           <strong>Pilih Suara :</strong> 
           <?php
            $voice = $panggil->getSuara();

            $pilF = "";
            $pilM = "";

            if($voice=="F")
            $pilF = "checked";
            elseif($voice=="M")
            $pilM = "checked";
           ?>
           <label class="btn btn-success"><input type="radio" value="M" name="suara" <?=$pilM?>><strong> <i class="material-icons"></i>MALE</strong> </label>
           <label class="btn btn-info"><input type="radio" value="F" name="suara" <?=$pilF?>><strong> FEMALE</strong></label>
           <input type="hidden" name="idloket" value="<?= $panggil->getloket() ?>">
          </form>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         


        
          <div class="row">
            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  
                    <h5><strong>ONLINE</strong></h5>                               
                    ANTRIAN YANG DILAYANI SAAT INI : <br/> <h4><strong><div id="nopanggilanA" ><?= $panggil->getCurrentAntrian("A") ?></div> </strong></h4>
                </div>
                <div class="card-body">
                 
                  <button class="btn btn-primary col-md-6" style="height:80px" onclick="callNext('A')"><h4><strong><div class="card-icon"><i class="material-icons">play_arrow</i> </div>     NEXT </strong> </h4></button>
                 
                  <button class="btn btn-light col-md-4" style="height:80px" onclick="reCall('A')"><h4><div class="card-icon"><i class="material-icons">refresh</i> </div>RECALL</h4></button>
                  
                </div>
                <div class="card-footer">
                  <h4>Sisa Antrian : <b><span id="sectionAsisa"></span></b></h4>      
                  <h4>Total Antrian : <b><span id="sectionAtotal"></span></b></h4>             
                  
                </div>
              
              </div>
            </div>
            <div class="col-md-3" >
              <div class="card card-chart">
                <div class="card-header card-header-success">
                                  
                    <h5><strong>LANSIA</strong></h5>                 
                    ANTRIAN YANG DILAYANI SAAT INI : <br/> <h4><strong><div id="nopanggilanB" ><?= $panggil->getCurrentAntrian("B") ?></div> </strong></h4>
               
                </div>
                <div class="card-body">
                <button class="btn btn-primary col-md-6" style="height:80px" onclick="callNext('B')"><h4><strong><div class="card-icon"><i class="material-icons">play_arrow</i> </div>     NEXT </strong> </h4></button>
                 
                 <button class="btn btn-light col-md-4" style="height:80px"  onclick="reCall('B')"><h4><div class="card-icon"><i class="material-icons">refresh</i> </div>RECALL</h4></button>
                  
                </div>
                <div class="card-footer">
                
                  
                <h4>Sisa Antrian :  <b><span id="sectionBsisa"></span></b></h4>      
                  <h4>Total Antrian :  <b><span id="sectionBtotal"></span></b></h4>          
                 
                         
                  
                </div>
               
              </div>
            </div>

            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                
                    <h5><strong>BAP</strong></h5>                 
                    ANTRIAN YANG DILAYANI SAAT INI : <br/> <h4><strong><div id="nopanggilanC" ><?= $panggil->getCurrentAntrian("C") ?></div> </strong></h4>
               


                </div>
                <div class="card-body">
                <button class="btn btn-primary col-md-6" style="height:80px" onclick="callNext('C')"><h4><strong><div class="card-icon"><i class="material-icons">play_arrow</i> </div>     NEXT </strong> </h4></button>
                 
                 <button class="btn btn-light col-md-4" style="height:80px"  onclick="reCall('C')"><h4><div class="card-icon"><i class="material-icons">refresh</i> </div>RECALL</h4></button>
                  
                </div>
                <div class="card-footer">
                <h4>Sisa Antrian :  <b><span id="sectionCsisa"></span></b></h4>      
                  <h4>Total Antrian :  <b><span id="sectionCtotal"></span></b></h4>                  
                  
                </div>
               
              </div>
            </div>

            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-info">
                
                    <h5><strong>PERCEPATAN</strong></h5>                 
                    ANTRIAN YANG DILAYANI SAAT INI : <br/> <h4><strong><div id="nopanggilanF" ><?= $panggil->getCurrentAntrian("F") ?></div> </strong></h4>
               


                </div>
                <div class="card-body">
                <button class="btn btn-primary col-md-6" style="height:80px" onclick="callNext('F')"><h4><strong><div class="card-icon"><i class="material-icons">play_arrow</i> </div>     NEXT </strong> </h4></button>
                 
                 <button class="btn btn-light col-md-4" style="height:80px"  onclick="reCall('F')"><h4><div class="card-icon"><i class="material-icons">refresh</i> </div>RECALL</h4></button>
                  
                </div>
                <div class="card-footer">
                <h4>Sisa Antrian :  <b><span id="sectionFsisa"></span></b></h4>      
                  <h4>Total Antrian :  <b><span id="sectionFtotal"></span></b></h4>                  
                  
                </div>
               
              </div>
            </div>

          </div>
         

           <div class="row">

           <div class="col-md-2"></div>


              <div class="col-md-4 ">
                  <div class="card card-chart ">
                  
                      <div class="card-body text-center">
                        <br>
                        <br>
                       
                        <h1 class="text-success"><b>LOKET <?= $panggil->getloket() ?></b></h1>
                        <div id="txt"></div>
                      
                        <br>
                      </div>
                  
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="card card-chart ">
                  
                      <div class="card-body text-center">
                       
                           <canvas id="myChart" style="width:100%;max-width:500px"></canvas>

                      </div>
                  
                  </div>
              </div>
         
   

              <div class="col-md-2"></div>

          </div>

        </div>
      </div>
 
    </div>
  </div>
 


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="message"></div> 
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<script>
  
  let xValues = [];
  let yValues = [];
  let chart = new Chart("myChart", {
                  type: "bar",
                  data: {
                    labels: xValues,
                    datasets: [{
                      backgroundColor: "#4C0099",
                      data: yValues
                    }]
                  },
                  options: {
                    legend: {display: false},
                    title: {
                      display: true,
                      text: "Grafik Pengawasan Antrian Paspor"
                    },
                    
                  }
                });
 
  setInterval(function(){
    $.ajax({
              type: "GET",
              url: "lib/grafikpanggilan.php",
              //data: {_tanggal : tanggal, _prefix : prefix, _no:no },
              contentType : 'application/json',
             
              success: function(dt){
                var res = JSON.parse(dt);
                
                xValues.length=0;
                
                yValues.length=0;
                //res.forEach(function(item){
                  for(key in res) {
               // console.log(res[key].loket);
                xValues[key]="Loket " + res[key].loket; 
                yValues[key]=res[key].jumlah;      
                }
                
                chart.update();
              },
              error: function(errMsg) {
                  //your error function
              }
          });
        
        },5000);


</script>

</body>

</html>