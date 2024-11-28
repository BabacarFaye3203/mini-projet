<?php
session_start();
include '../database/DatabaseCreat.php';
if (isset($_POST['Annuler'])) {
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

}
?>
