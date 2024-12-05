<?php
session_start();
include '../../database/DatabaseCreat.php';
if (isset($_POST['Accepter'])) {
    $idP = $_SESSION['idP_Patient'];
    $idM = $_POST['idM'];
    $idr = $_POST['idr'];

    $query_rendez_vous0 = "UPDATE  rendezvous SET statut='accepté' WHERE idR_RendezVous=? ";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("i",$idr);
        if ( $stmt_supp->execute()===TRUE ) {
            //   $connect->commit();
            echo "<script>alert('Votre rendez-vous a été planifié')</script>";
            // header("Location: profilMed.php");
            header("Location: Gest_RDVMed.php");
        }
}

