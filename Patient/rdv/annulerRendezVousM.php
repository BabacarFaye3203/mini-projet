<?php
session_start();
include '../../database/DatabaseCreat.php';
if (isset($_POST['Annuler'])) {
    $idP=$_SESSION['idP_Patient'];
    $idM = $_POST['idM'];
    $idr=$_POST['idr'];

//insertion des rendez-vous annulés
    $query = "INSERT INTO rdvn (idR, type, dat, idP, idM) 
VALUES ($idr,'$typ','$dat',$idP,$idM)
";

//mises a jours
    $query_rendez_vous0 = "UPDATE rendezvous SET statut='annulé' WHERE idR_RendezVous=?";
    $stmt_supp = $connect->prepare($query_rendez_vous0);
    $stmt_supp->bind_param("i", $idr);
        if ( $stmt_supp->execute()===TRUE ) {
            //   $connect->commit();
            echo "<script>window.alert('Le rendez-vous est annulé')</script>";
            // header("Location: profilMed.php");
            header("Location: Gest_RDVMed.php");
        }
}

?>
