<?php
session_start();
include '../../database/DatabaseCreat.php';
if (isset($_POST['Annuler'])) {k
    $idM=$_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $dat = $_POST['dat'];
    $idr=$_POST['idr'];
    $typ=$_POST['typ'];

//insertion des rendez-vous annulés
    $query = "INSERT INTO rdvn (idR, type, dat, idP, idM) 
VALUES ($idr,'$typ','$dat',$idP,$idM)
";

//mises a jours
    $query_rendez_vous0 = "DELETE FROM rendezvous WHERE dateR_RendezVous=? and idP_Patient=?;";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("si", $dat, $idP);
//mise a jours
    $query_rendez_vous0 = "DELETE FROM rdvn WHERE dat< LOCALTIME and idP = ?;";
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
            echo "<script>window.alert('Votre rendez-vous a été annulé')</script>";
            // header("Location: profilMed.php");
            header("Location: Gest_RDV.php");
        }
    }
}

?>
