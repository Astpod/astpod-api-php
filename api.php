<?php

header("Content-Type: application/json; utf-8;");

error_reporting(0);


$auth="astpod";
if (!isset($_GET['auth'])) {
    echo json_encode(["success" => "false", "message" => "Gerçesiz Key."]);
    
    die();
}else if($_GET['auth']!=$auth){
    echo json_encode(["success" => "false", "message" => "Auth Error"]);
   
   
    die();
}
if (isset($_GET["gsm"])) {
    $gsm = htmlspecialchars($_GET["gsm"]);
    $sql = "";
if (!empty($gsm)) {
    $link = new mysqli("localhost", "kuladi", "sifre", "database");

    $sql = "SELECT * FROM astpod_gsmdata WHERE gsm=?";
    $result = $link->prepare($sql);
    $result->bind_param("s", $gsm);
    $result->execute();
    $result = $result->get_result(); 
  
 

    if (!$result) {
        echo json_encode(["success" => "false", "message" => "Sunucu Hatası"]);
        die();
    }
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($resultarray, $row);
    }
    $bulunans = $result->num_rows;

    if ($bulunans < 1) {
        echo json_encode(["success" => "false", "message" => "Herhangi bir sonuç bulunamadı."]);
      
        
         die();
    }

    echo json_encode(["success" => "true", "number" => $bulunans, "data" => $resultarray]);
   
  
   
    die();
} else {
    echo json_encode(["success" => "false", "message" => "Data istek gönderilemedi."]);
    die();
}
}else if (isset($_GET["tc"])) {
    $gsm = htmlspecialchars($_GET["tc"]);
    $sql = "";
if (!empty($gsm)) {
    $link = new mysqli("localhost", "kullanıcıadı", "şifre", "database");

    $sql = "SELECT * FROM astpod_gsmdata WHERE tc=?";
    $result = $link->prepare($sql);
    $result->bind_param("s", $gsm);
    $result->execute();
    $result = $result->get_result(); 
  
 

    if (!$result) {
        echo json_encode(["success" => "false", "message" => "Sunucu Hatası"]);
        die();
    }
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($resultarray, $row);
    }
    $bulunans = $result->num_rows;

    if ($bulunans < 1) {
        echo json_encode(["success" => "false", "message" => "Herhangi bir sonuç bulunamadı"]);
      
        
         die();
    }

    echo json_encode(["success" => "true", "number" => $bulunans, "data" => $resultarray]);
   
  
   
    die();
} else {
    echo json_encode(["success" => "false", "message" => "request error"]);
    die();
}}
