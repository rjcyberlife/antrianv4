<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
require_once("connection.php");

$db = new database;
$database = $db->__construct();

$data = $_POST['data'];
$tbl = $_POST['tbl'];

if(!empty($data))
{
  

    
    //$data = file_get_contents('php://input');
    $json = json_decode($data,false);
    
    
    if($tbl=="tiket"){

        $query = $database->query("SELECT*FROM tiket_layanan where id=".$json->id);
        $result = $database->affected_rows;

                    if($result==0)
                    {
                        $insertq = $database->query("INSERT INTO tiket_layanan VALUES(
                        '$json->id','$json->tanggal','$json->A','$json->B','$json->C','$json->F',
                        '$json->lastA','$json->lastB','$json->lastC','$json->lastF',
                        '$json->loketA','$json->loketB','$json->loketC','$json->loketF',
                        '$json->created_at',
                        '$json->updated_at'
                        )");
                    //  echo "INSERT INTO tiket_layanan2 VALUES(".json_encode($json).")";
                    } else
                    {
                        $updateq = $database->query("UPDATE tiket_layanan SET 
                        A='$json->A',B='$json->B',C='$json->C',F='$json->F',
                        lastA='$json->lastA',lastB='$json->lastB',lastC='$json->lastC',lastF='$json->lastF',
                        loketA='$json->loketA',loketB='$json->loketB',loketC='$json->loketC',loketF='$json->loketF',
                        created_at='$json->created_at',
                        updated_at='$json->updated_at' 
                        WHERE id = $json->id
                        ");

                    }
    } elseif($tbl=="panggil"){
        $query = $database->query("SELECT*FROM panggil where id=".$json->id);
        $result = $database->affected_rows;

                    if($result==0)
                    {
                        $insertq = $database->query("INSERT INTO panggil VALUES(
                        '$json->id','$json->tanggaljam','$json->prefix','$json->nomor_urut','$json->loket')");                    
                    }
    }


echo "success";

} else
{

    echo "Invalid request!";
}


?>