<?php
session_start();
include '../../database/DatabaseCreat.php';
/*if (isset($_POST['Accepter'])) {
    $idM = $_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $dat = $_POST['dat'];
    $idr = $_POST['idr'];f
    $typ = $_POST['typ'];

    //Insertion des RDV acceptés
    $query = "INSERT INTO rdva (idR, type, dat, idP, idM) 
VALUES ($idr,'$typ','$dat',$idP,$idM)
";
    //mises a jours
    $query_rendez_vous0 = "DELETE FROM rendezvous WHERE idR_RendezVous=? and  dateR_RendezVous=? and idP_Patient=?;";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("si", $dat, $idP);
        if ( $stmt_supp->execute()===TRUE ) {
            echo "<script>alert('Votre rendez-vous a été planifié')</script>";
            header("Location: Gest_RDV.php");
        }
}
*/
if (isset($_POST['Accepter'])) {
    $idM = $_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $idr = $_POST['idr'];
//mises a jours
    $query_rendez_vous0 = "UPDATE  rendezvous SET statut='accepté' WHERE idR_RendezVous=? ";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("i",$idr);

        if ($stmt_supp->execute() === TRUE) {
            echo "<script>window.alert('Votre rendez-vous a été planifié')</script>";
            header("Location: Gest_RDV.php");
        }
}



