
let playantrian = false;

function getPanggilanSuara ()
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
            
            if(res != null && playantrian == false) {
              playantrian = true;
              panggil_nomor(res.id + ";" +res.prefix + ";" + res.nomor_urut + ";" + res.loket  + ";" + res.voice);      
              //blink(res.prefix);
              
              
            }

            }
          }

        xmlHttp.open("GET","lib/mainscreen.php",true);
        xmlHttp.send(null);
         

}


function deleteQueue (id)
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
            


            }
          }

          xmlHttp.open("GET","lib/mainscreen.php?delete=true&id=" + id,true);
          xmlHttp.send(null);
      

}


function blink(layanan){

    for (i=1;i<7;i++){
      $('.blink_'+layanan).fadeOut(500);
      $('.blink_'+layanan).fadeIn(500);
  }


}

function play(id,voice)
{
  // id = "men_" +id;

  if(voice=="M")
  src = "audio/male/"+id+".mp3";
  else
  src = "audio/female/"+id+".mp3";


  const playPromise=new Audio(src);
  playPromise.currentTime=0;
  playPromise.play();
  //const playPromise=document.getElementById(id).play();
  // if(playPromise !== null) // Jika tidak diblock browser, jalankan
  // {
  //   playPromise.catch(() => {
  //     document.getElementById(id).pause();
  //     // document.getElementById(id).muted=false;
  //     document.getElementById(id).currentTime=0;
  //     document.getElementById(id).play();
  //   })
  // }
}



function panggil_nomor(nomor)
{
  
  totalwaktu=0;
  
  var input = nomor.split(";");
  // console.log(nomor);
  id = input[0];
  nomor = input[2];
  prefix = input[1].toLowerCase();
  loket  = input[3];
  voice  = input[4];

  // stopallaoudio();
  if(nomor < 1000) // File audio nya cuma bisa sampe 999 :D
  {

        setTimeout(function(){ 
          play('opener',voice); 
        },totalwaktu);
        totalwaktu=totalwaktu+2000;

        setTimeout(function(){ 
          play('nomorantrian',voice); 
        },totalwaktu);
        totalwaktu=totalwaktu+2000;

        setTimeout(function(){ 
          play(prefix,voice); 
        },totalwaktu);
        totalwaktu=totalwaktu+1000;

    if(nomor > 20) // Di audio file ada audio dari 1-20, jadi kita filter mulai dari 21
    {
      var satuan='';
      if(nomor.toString().length == 3) // Jika jumlah karakter 3 100-999
      {
        satuan='ratus'; //bikin satuan ratus
      }
      
      if(nomor > 20 && nomor < 100) // Bikin pemanggil puluhan
      {
        var b1=nomor.toString().substring(0,1); // Ambil karakter pertama misal 2
        var puluh=b1+'0'; //jadikan ke puluhan 10-90
        setTimeout(function(){ //setTimeout dibikin untuk stop periode audionya. 
          play(''+puluh+'',voice); //play yg puluhan misal *dua puluh*
        },totalwaktu);
        totalwaktu=totalwaktu+1000; //Selalu tambahkan delay-nya
        
        var b2=nomor.toString().substring(1,2); //Ambil karakter 2
        if(b2 !='0') // Filter 0 terlebih dahulu, karena ada audio 10-90
        {
          setTimeout(function(){
            play(''+b2+'',voice); //Mainkan karakter ke dua, Milal 3 "tiga"
          },totalwaktu);
          totalwaktu=totalwaktu+1000; //tambah delay
        }
        
      }
      
      if(satuan == 'ratus') // bikin pemanggil ratusan
      {
        var b1=nomor.toString().substring(0,1); //Ambil karakter pertama. Misal 2
        var ratus=b1+'00'; //jadikan ke ratusan 100-900. Misal 200 
        setTimeout(function(){
          play(''+ratus+'',voice); //mainkan yg ratusan misal *dua ratus*
        },totalwaktu);				
        totalwaktu=totalwaktu+1300; //tambah delay
        
        
        //Panggil puluhan
        var b2=nomor.toString().substring(1,2); //Ambil karakter ke 2. Utk menentukan apakah 0 atau tidak. Contoh 234 karakter ke 2 nya adalah 3. Klo 204, maka karakter ke 2 nya adalah 0
        var b23=nomor.toString().substring(1,3); //Ambil karakter ke 2 dan 3. Menentukan apakah ini puluhan atau tidak. 234 jadi 34					
        var b3=nomor.toString().substring(2,3); //Ambil karakter ke 3. Klo b2 nilai 0 maka. Referensi b2
        
        if(b23 > 0) //jika karakter ke 2 dan 3 lebih dari 0
        {
          if(b23 > 20 && b23 < 100) // Filter yg ga ada audio 21-99
          {
            var bx1=b23.toString().substring(0,1); //Cari karakter 1 dari pecahan karakter ke 2 dan 3
            var puluh=bx1+'0'; //jadikan variable puluhan 10,20,30,dst
            setTimeout(function(){
              play(''+puluh+'',voice); //mainkan puluh
            },totalwaktu);
            totalwaktu=totalwaktu+1500; //delay
            
            var bx23=b23.toString().substring(1,2); //Cari karakter 2 dari pecahan karakter ke 2 dan 3
            if(bx23 !='0') //Filter jika tidak 0. Karena klo 0, maka jalankan yg puluhan aja
            {
              setTimeout(function(){
                play(''+bx23+'',voice); //Mainkan karakter ke 3
              },totalwaktu);
              totalwaktu=totalwaktu+1000; //Delay
            }
          }
          else if(b23 > 10 && b23 < 20){ //jika belasan

            setTimeout(function(){
              play(''+b23+'',voice); //Mainkan karakter belasam
            },totalwaktu);
            totalwaktu=totalwaktu+1000; //Delay
          }
          else{
            b23 = Math.abs(b23);
            console.log(b23);
            setTimeout(function(){ 
              play(''+b23+'',voice); //Kalau 204, maka mainkan 4 *empat* aja
            },totalwaktu);
            totalwaktu=totalwaktu+1000; //reset lg delay jd 0
          }
        }
        
      }

     

      
    }else{
      setTimeout(function(){
        play(''+nomor+'',voice); //Mainkan 1 sampai 20
      },totalwaktu);
      totalwaktu=totalwaktu+1000;
    }

    setTimeout(function(){ 
      play('diloket',voice); 
    },totalwaktu);
    totalwaktu=totalwaktu+1000;

    setTimeout(function(){  
      play('' + loket,voice); //play audio loket
    },totalwaktu);

    totalwaktu=totalwaktu+1000;
    setTimeout(function(){  
      deleteQueue (id);
      //playantrian = false;
    },totalwaktu);
  
    setTimeout(function(){  
      
      playantrian = false;
      
    },totalwaktu+2000);
   
    totalwaktu=0;
    
  } else
  {
    alert('Range 1 - 999');
  }
}
