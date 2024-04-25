<?php

require_once("connection.php");

class panggilan extends database
{

    public $mac;

    public function __construct()
    {
        $this->conn = parent::__construct();

        // ob_start();
        // system('getmac');
        // $Content = ob_get_contents();
        // ob_clean();

        // $this->mac = substr($Content, strpos($Content,'\\')-20, 17);

        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
        
        if($_IP_ADDRESS=='::1')
        {
            $_HASIL='::1';
        } 
        else
        {
            $_PERINTAH = "arp -a $_IP_ADDRESS";
            ob_start();
            system($_PERINTAH);
            $_HASIL = ob_get_contents();
            ob_clean();
            $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
            $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
            $_HASIL = substr($_PECAH_STRING[1], 0, 17);
           // var_dump( $_PECAH_STRING);
        }
        $this->mac = $_HASIL;
    }

   public function getClientMAC()
   {
        

        $query = $this->conn->query("SELECT*FROM loket where mac_address='". $this->mac. "'");
        $result = $this->conn->affected_rows;

        if ($result==0){
            return false;
        } else
            return true;
    }

    public function getloket()
    {

        $query = $this->conn->query("SELECT*FROM loket where mac_address='". $this->mac. "'");
        $row = $query->fetch_assoc();
        $no_loket = $row['loket'];

        return $no_loket;
    }

    
    public function getTotalAntrian()
    {

        $query = $this->conn->query("SELECT * FROM tiket_layanan where tanggal=CURDATE()");
        $row = $query->fetch_assoc();

        // if($row<>NULL)
        // $jml_antrian = $row[$jenislayanan];
        // else
        // $jml_antrian = 0;
       
        $json = json_encode($row);

        return $json;
    }

    public function getPanggilTemp()
    {

        $query = $this->conn->query("SELECT * FROM panggil_temp where DATE(tanggaljam)=CURDATE() ORDER BY id ASC limit 1");
        $row = $query->fetch_assoc();

        // if($row<>NULL)
        // $jml_antrian = $row[$jenislayanan];
        // else
        // $jml_antrian = 0;
       
        $json = json_encode($row);
       // if($row!=NULL)
        //$query = $this->conn->query("DELETE FROM panggil_temp where id=".$row['id']);

        return $json;


    }

    public function getLastPanggil()
    {
        $query = $this->conn->query("SELECT*FROM panggil ORDER BY id DESC limit 1");
        $row = $query->fetch_assoc();
        $json = json_encode($row);
        return $json;
    }


    public function getNoLoketTerpanggil($tanggal,$prefix,$no)
    {
        $query = $this->conn->query("SELECT*FROM panggil where DATE(tanggaljam)='$tanggal' AND prefix='$prefix' AND nomor_urut=$no limit 1");
        $row = $query->fetch_assoc();
        $json = json_encode($row);
        return $json;
    }

    public function deletePanggilTemp($id)
    {

        $query = $this->conn->query("DELETE FROM panggil_temp where id=".$id);
      
        return true;

     
    }


    public function isPanggilExist()
    {

        $query = $this->conn->query("SELECT * FROM panggil_temp");
        $row = $query->fetch_assoc();
        

        if($row==null)          
            return false;        
        else 
            return true;

    }


    public function nextAntrian(string $layanan)
    {

        $query = $this->conn->query("SELECT * FROM tiket_layanan where tanggal=CURDATE()");
        $row = $query->fetch_assoc();

        if($row!= NULL)
        {
            $current = $row[$layanan]; 
            $last = $row['last'.$layanan] + 1;

            if ($last<=$current) {
                 $this->conn->query("UPDATE tiket_layanan SET last".$layanan."= $last , loket".$layanan."= ".$this->getloket()." where tanggal=CURDATE()");
                 $this->conn->query("INSERT INTO panggil (prefix,nomor_urut,loket) VALUES ('$layanan','$last',".$this->getloket().")");
                 $this->conn->query("INSERT INTO panggil_temp (prefix,nomor_urut,loket,voice) VALUES ('$layanan','$last',".$this->getloket().",'".$this->getSuara()."')");
                 //echo "INSERT INTO (tanggaljam,prefix,nomor_urut,loket) VALUES (CURDATE(),'$layanan','$last',".$this->getloket().")";
                $next = $layanan." - ".sprintf("%03s", $last);
            }
            else
                $next = $this->getCurrentAntrian($layanan);
        }
        else {
            $next = "-";
        }

        return $next;
        
    }

    public function reCall(string $layanan)
    {

        $query = $this->conn->query("SELECT MAX(nomor_urut) as no FROM panggil where DATE(tanggaljam)=CURDATE() AND loket=".$this->getloket()." AND prefix='$layanan'");
        //echo "SELECT MAX(nomor_urut) as no FROM panggil where DATE(tanggaljam=CURDATE() AND loket=".$this->getloket()." AND prefix='$layanan'";
        $row = $query->fetch_assoc();

        if($row<> NULL && $row['no']<> NULL)
        {
            $this->conn->query("INSERT INTO panggil_temp (prefix,nomor_urut,loket,voice) VALUES ('$layanan','".$row['no']."',".$this->getloket().",'".$this->getSuara()."')");
        }
        else{
            $current = "-";
        }

        return $current;

    }

    public function getCurrentAntrian(string $layanan)
    {

        $query = $this->conn->query("SELECT MAX(nomor_urut) as no FROM panggil where DATE(tanggaljam)=CURDATE() AND loket=".$this->getloket()." AND prefix='$layanan'");
        //echo "SELECT MAX(nomor_urut) as no FROM panggil where DATE(tanggaljam=CURDATE() AND loket=".$this->getloket()." AND prefix='$layanan'";
        $row = $query->fetch_assoc();

        if($row<> NULL && $row['no']<> NULL)
        {
            $last = $row['no'] ;
            $current = $layanan." - ".sprintf("%03s", $last);
        }
        else{
            $current = "-";
        }

        return $current;

    }

    public function updateSuara($loket,$suara)
    {
        if ($loket <> "" && $suara<>"")
        {
          
            $query = $this->conn->query("UPDATE loket SET voice ='$suara' WHERE loket=".$this->getloket()."");
            
        }
    }

    public function getSuara()
    {

        $query = $this->conn->query("SELECT voice FROM loket where loket=".$this->getloket()."");
        //echo "SELECT MAX(nomor_urut) as no FROM panggil where DATE(tanggaljam=CURDATE() AND loket=".$this->getloket()." AND prefix='$layanan'";
        $row = $query->fetch_assoc();

        return $row["voice"];
    }


}


?>