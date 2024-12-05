<?php
session_start();
include '../../database/DatabaseCreat.php';
if (isset($_POST['Annuler'])) {
    $idM=$_SESSION['idM_Medecin'];
    $idP = $_POST['idP'];
    $idr=$_POST['idr'];
//mises a jours
    $query_rendez_vous0 = "UPDATE rendezvous SET statut='annulé' WHERE idR_RendezVous=?";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("i", $idr);
        if ( $stmt_supp->execute()===TRUE ) {
            echo "<script>window.alert('Le rendez-vous est annulé')</script>";
            header("Location: Gest_RDV.php");
        }
}
?>
