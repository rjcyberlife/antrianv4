function startTime() {
    var today = new Date();
    
    
    switch (today.getDay()) {
    case 0: day = "Minggu";
      break;
    case 1: day = "Senin";
      break;
    case 2: day = "Selasa";
      break;
    case 3: day = "Rabu";
      break;
    case 4: day = "Kamis";
      break;
    case 5: day = "Jumat";
      break;
    case 6: day = "Sabtu";
  }

  switch (today.getMonth()) {
    case 0: bln = "Januari";break;
    case 1: bln = "Februari";break;
    case 2: bln = "Maret";break;
    case 3: bln = "April"; break;
    case 4: bln = "Mei"; break;
    case 5: bln = "Juni"; break;
    case 6: bln = "Juli";break;
    case 7: bln = "Agustus";break;
    case 8: bln = "September";break;
    case 9: bln = "Oktober"; break;
    case 10: bln = "November"; break;
    case 11: bln = "Desember"; break;
   
  }

    var tgl = today.getDate();        
    var thn = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);

    if(document.getElementById("txt") !== null)
    document.getElementById('txt').innerHTML =
    "<p style='font-size:25px'>" + h + ":" + m + ":" + s + "<br>" + "</p>" +
    "<h4>" + day + " , " + tgl + " " + bln + " " + thn + "</h4>";


    if(document.getElementById("txttanggal") !== null)
    {
       document.getElementById('txttanggal').innerHTML = 
    "<p style=\"font-size:12px\">" + day + " , " + tgl + " " + bln + " " + thn + " " + h + ":" + m + ":" + s + "</p>"   ;
    
    }

    if(document.getElementById("txttanggal1") !== null)
    {
       document.getElementById('txttanggal1').innerHTML = 
    "<br><p  style='font-size:25px'><b>" + day + " , " + tgl + " " + bln + " " + thn + " " + h + ":" + m + ":" + s + "</b></p>"   ;
    
    }
   
    setTimeout(startTime,500);

}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


function cetaknomor(layanan)
{


    var xmlHttp;
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4) {
              // console.log(xmlHttp.responseText);
            $("#section" + layanan).html(xmlHttp.responseText);
            $("#textantrian").html(xmlHttp.responseText);
           // printDiv();
            var a = window.open ("lib/cetaktiket.php?layanan=" + layanan);
           
            //  a.print();
           // a.close();
            }
          }

        xmlHttp.open("GET","lib/ceknomor.php?layanan=" + layanan,true);
        xmlHttp.send(null);
        
        

      
}

function callNext(layanan)
{

  if(isPanggilExist()=="false")
  {


    var xmlHttp;
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4) {
            //   console.log(xmlHttp.responseText);
            if($("#nopanggilan" + layanan).html() ==xmlHttp.responseText)
              {
                message =  "Antrian belum tersedia untuk layanan ini";
                $("#message").html(message);
                $("#exampleModal").modal('show');
            }
              else
            $("#nopanggilan" + layanan).html(xmlHttp.responseText);
            getTotalAntrian();
            
            }
          }

        xmlHttp.open("GET","lib/nextantrian.php?layanan=" + layanan,true);
        xmlHttp.send(null);
        
      } else {
        message = 'Sabar ya panggilan lain sedang berlangsung';
        $("#message").html(message);
        $("#exampleModal").modal('show');
       
}
      
}



function isPanggilExist()
{

    var xmlHttp;
    var exist="false";
    
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }

   
      

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4) {
             
               
                
                //message=xmlHttp.responseText;
                     exist = xmlHttp.responseText;
                     //console.log(exist);
            }
          }
        
        xmlHttp.open("GET","lib/cekpanggil.php",false);
        xmlHttp.send(null);
              
        
     //console.log(exist);
        return exist;      
}

function getTotalAntrian()
{
    var xmlHttp;
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }


        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4) {
            
            var res = JSON.parse(xmlHttp.responseText);

           
            
            nopanggilanC
            $("#sectionAtotal").html(res.A);            
            $("#sectionBtotal").html(res.B);
            $("#sectionCtotal").html(res.C);
            $("#sectionFtotal").html(res.F);
            
            sisaA = res.A-res.lastA;
            sisaB = res.B-res.lastB;
            sisaC = res.C-res.lastC;
            sisaF = res.F-res.lastF;

            $("#sectionAsisa").html(sisaA);            
            $("#sectionBsisa").html(sisaB);
            $("#sectionCsisa").html(sisaC);
            $("#sectionFsisa").html(sisaF);
         

            
            }
          }

        xmlHttp.open("GET","lib/cekantrian.php",true);
        xmlHttp.send(null);
         

      
}


function getNomorTerpanggil()
{
    var xmlHttp;
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }


        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState === 4) {
            
            var res = JSON.parse(xmlHttp.responseText);
            
            var panggilA =  (res.lastA != 0) ? 'A - ' + String(res.lastA).padStart(3, '0') : "A ";
            var panggilB =  (res.lastB != 0) ?'B - ' + String(res.lastB).padStart(3, '0') : "B ";
            var panggilC =  (res.lastC != 0) ?'C - ' + String(res.lastC).padStart(3, '0') : "C ";
            var panggilF =  (res.lastF != 0) ?'F - ' + String(res.lastF).padStart(3, '0') : "F ";

            var loketA =  (res.loketA == 0) ?  "-" :res.loketA;
            var loketB =  (res.loketB == 0) ?  "-":res.loketB;
            var loketC =  (res.loketC == 0) ?  "-":res.loketC ;
            var loketF =  (res.loketF == 0) ?  "-":res.loketF ;
            
            $("#txtnoA").html(panggilA);            
            $("#txtnoB").html(panggilB);
            $("#txtnoC").html(panggilC);
            $("#txtnoF").html(panggilF);

            $("#txtloketA").html(loketA);            
            $("#txtloketB").html(loketB);
            $("#txtloketC").html(loketC);
            $("#txtloketF").html(loketF);
         

            
            }
          }

        xmlHttp.open("GET","lib/cekantrian.php",true);
        xmlHttp.send(null);
         

      
}



function reCall(layanan)
{

  // isPanggilExist();
  
  if(isPanggilExist()=="false")
  {

    var xmlHttp;
        try{
          xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
        }
        catch (e){
          try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
          }
          catch (e){
            try{
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
              alert("No AJAX");
              return false;
            }
          }
        }

        xmlHttp.open("GET","lib/recall.php?layanan=" + layanan,true);
        xmlHttp.send(null);
         
      } else {
                message = 'Sabar ya panggilan lain sedang berlangsung';
                $("#message").html(message);
                $("#exampleModal").modal('show');
               
      }
      
}

function printDiv() {

   
    var divContents = document.getElementById("print").innerHTML;    
    var a = window.open('', '', 'height=500, width=500');
    a.document.write('<html>');
    a.document.write('<body ><center> ');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
    a.close();
}

function refreshAt(hours, minutes, seconds) {
  var now = new Date();
  var then = new Date();

  if(now.getHours() > hours ||
      (now.getHours() == hours && now.getMinutes() > minutes) ||
      now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
      then.setDate(now.getDate() + 1);
  }
  then.setHours(hours);
  then.setMinutes(minutes);
  then.setSeconds(seconds);

  var timeout = (then.getTime() - now.getTime());
  setTimeout(function() { location.reload(); }, timeout);
}
