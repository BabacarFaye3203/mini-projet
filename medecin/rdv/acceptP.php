<?php
session_start();
include '../../database/DatabaseCreat.php';
if (isset($_POST['Accepter'])) {
    $idM = $_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $dat = $_POST['dat'];
    $idr = $_POST['idr'];o
    $typ = $_POST['typ'];

    //Insertion des RDV acceptés
    $query = "INSERT INTO rdva (idR, type, dat, idP, idM) 
VALUES ($idr,'$typ','$dat',$idP,$idM)
";
    //mises a jours
    $query_rendez_vous0 = "DELETE FROM rendezvous WHERE idR_RendezVous=? and  dateR_RendezVous=? and idP_Patient=?;";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("isi",$idr, $dat, $idP);
//mise a jours
    $query_rendez_vous0 = "DELETE FROM rdva WHERE dat< LOCALTIME and idP = ?;";
    //$connect->query($query_rendez_vous0);
    $stmt_a = $connect->prepare($query_rendez_vous0);
    $stmt_a->bind_param("i", $idP);
    $stmt_a->execute();
    try {
        $connect->query($query);
    }catch (Exception $e){
        exit();
    }
   finally{
        if ( $stmt_supp->execute()===TRUE ) {
            //   $connect->commit();
            echo "<script>alert('Votre rendez-vous a été planifié')</script>";
            // header("Location: profilMed.php");
            header("Location: Gest_RDV.php");
        }
    }
}

