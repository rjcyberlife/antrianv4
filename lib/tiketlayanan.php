<?php

require_once("connection.php");

class tiketlayanan extends database
{

    public $conn ;

        public function __construct()
        {
           $this->conn = parent::__construct();
        }

        // cek nomor antrian terakhir
        public function getnomor(string $jenislayanan) 
        {   
            $this->insertToday();
                                   
            $query = $this->conn->query("SELECT $jenislayanan FROM tiket_layanan where tanggal=CURDATE()");

            $row = $query->fetch_assoc();
            $jml_antrian = $row[$jenislayanan];
            $jml_digit  = strlen($row[$jenislayanan]);

            $noantri = $jenislayanan." - ".sprintf("%03s", $jml_antrian);

            return $noantri;
            
        }
        
        //cek jika antrian hari ini masih kosong
        public function insertToday () 
        {
            
            $query = $this->conn->query("SELECT*FROM tiket_layanan where tanggal=CURDATE()");
            $result = $this->conn->affected_rows;

            if($result==0)
            {
                $insertquery = $this->conn->query("INSERT INTO tiket_layanan(tanggal) VALUES(CURDATE())");
            }        

        }

        // tambah nomor antrian
        public function insertAntrianBaru (string $jenislayanan) 
        {
            $this->insertToday();

            $query = $this->conn->query("UPDATE tiket_layanan SET $jenislayanan = $jenislayanan +1, updated_at=CURRENT_TIMESTAMP WHERE tanggal = CURDATE()");
        }

        

}


?>