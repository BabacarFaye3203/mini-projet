<?php
include 'connexion_db.php';
try{
    $rq1="CREATE DATABASE carnet";
    $stm=$connect->prepare($rq1);
    $stm->execute();
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $selec="USE carnet";
    mysqli_query($connect,$selec);
}catch(Exception $e){
    echo"erreur de selection".$e->getMessage();
}