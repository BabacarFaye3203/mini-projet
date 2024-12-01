<?php
session_start();
include '../database/DatabaseCreat.php';
if (isset($_POST['Annuler'])) {
    $idP=$_SESSION['idP_Patient'];
    $idM = $_POST['idM'];
    $dat = $_POST['dat'];
    $idr=$_POST['idr'];
    $typ=$_POST['typ'];

//insertion des rendez-vous annulés
    $query = "INSERT INTO rdvn (idR, type, dat, idP, idM) 
VALUES ($idr,'$typ','$dat',$idP,$idM)
";

//mises a jours
    $query_rendez_vous0 = "DELETE FROM rendezvous WHERE idR_RendezVous=? and dateR_RendezVous=? and idM_Medecin=?;";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("isi",$idr, $dat, $idM);
//mise a jours
    $query_rendez_vous0 = "DELETE FROM rdvn WHERE dat< LOCALTIME and idM = ?;";
    $stmt_a = $connect->prepare($query_rendez_vous0);
    $stmt_a->bind_param("i", $idM);
    $stmt_a->execute();
    try {
        $connect->query($query);
    }catch (Exception $e){
        exit();
    }
    finally{
        if ( $stmt_supp->execute()===TRUE ) {
            //   $connect->commit();
            echo "<script>window.alert('Votre rendez-vous a été annulé')</script>";
            // header("Location: profilMed.php");
            header("Location: Gest_RDVMed.php");
        }
    }
}

?>
