<?php
session_start();
include '../database/DatabaseCreat.php';

if (isset($_POST['Annuler'])) {
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
            echo "<script>window.alert('Votre rendez-vous a été annulé')</script>";
            header("Location: Gest_RDV.php");
        }
    }
}


/*if (isset($_POST['Annuler'])) {
    $idM=$_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $dat = $_POST['dat'];

    $query_patient = "SELECT nomP_Patient, prenomP, dat_naiss, emailP FROM patient WHERE idP_Patient = ?";
    $stmt_patient = $connect->prepare($query_patient);
    $stmt_patient->bind_param("i", $idP);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $patient = $result_patient->fetch_assoc();

    $query_rendez_vous0="DELETE FROM rendezvous WHERE dateR_RendezVous='$dat' and idP_Patient=$idP;";
    if ($connect->query($query_rendez_vous0) === TRUE) {
        echo "Record deleted successfully";
        header("Location: Gest_RDV.php");
        exit();
    }
}*/
?>
