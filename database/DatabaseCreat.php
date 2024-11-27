<?php
include "connexion_db.php";
try{
    $bdname="carnet";
    $rq1="CREATE DATABASE IF NOT EXISTS $bdname";
    $connect->query($rq1);
    echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    //$selec="USE $bdname";
    //mysqli_query($connect,$selec);
    //$connect=new mysqli($connect,$bdname);
    mysqli_select_db($connect,$bdname);
    echo "<br>Selection ok";
}catch(Exception $e){
    echo"erreur de selection".$e->getMessage();
}