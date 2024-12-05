<?php
session_start();
include '../../database/DatabaseCreat.php'; // Connexion à la base de données
// Vérifie si les données ont été soumises
if (isset($_POST['modifRDV'])) {
    $idM = $_SESSION['idP_Patient']; // ID du medecin connecté
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $lieu=$_POST['lieu'];
    $idr=$_POST['idr'];
    if (!empty($idP) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "UPDATE rendezvous SET statut='reprogrammé',lieu=?,dateR_RendezVous=? where idR_RendezVous=?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssi",$lieu,$date_rdv, $idr);
        
        if ($stmt->execute() ) {
            // Redirige avec un message de succès
            header("Location: ../rdv/Gest_RDVMed.php?success=Rendez-vous ajouté avec succès");
            exit();
        } else {
            echo "<script>window.alert('Erreur : Impossible de sauvegarder le rendez-vous.')</script>";
        }
    }
}



