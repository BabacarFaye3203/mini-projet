<?php
/*session_start();
include '../../database/DatabaseCreat.php'; // Connexion à la base de données

// Vérifie si les données ont été soumises
if (isset($_POST['modifRDV'])) {
    $idM = $_SESSION['idM_Medecin']; // ID du medecin connecté
    $idP = $_POST['idP']; // ID du patient sélectionné
    $datA=$_POST['datA'];
    $motif=$_POST['motif'];
    $date_rdv = $_POST['dat']; // Date et heure du rdv
    $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient,idM_Medecin) VALUES ($date_rdv, $motif, ,?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssii", $date_rdv,strip_tags($motif),$idP,$idM);
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $query = "INSERT INTO rdva (idR, type, dat, idP, idM) 
        VALUES ($idr,'$typ','$dat',$idP,$idM)";
    $query_rendez_vous0 = "DELETE FROM rdvn WHERE dat=? and idP = ?;";
    $stmt_a = $connect->prepare($query_rendez_vous0);
    $stmt_a->bind_param("si",$datA, $idP);
    $stmt_a->execute();
    header("Location: Gest_RDV.php");
    exit();
}
*/
session_start();
include '../../database/DatabaseCreat.php'; // Connexion à la base de données
// Vérifie si les données ont été soumises
if (isset($_POST['modifRDV'])) {
    $idM = $_SESSION['idM_Medecin']; // ID du medecin connecté
    $idP = $_POST['idP']; // ID du patient sélectionné
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $motif = $_POST['motif'];//moitif du rdv
    $datA=$_POST['datA'];
    if (!empty($idP) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient,idM_Medecin) VALUES (?, ?, ?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssii", $date_rdv, $motif, $idP, $idM);

        $query_rendez_vous0 = "DELETE FROM rdvn WHERE dat=? and idP = ?;";
        $stmt_a = $connect->prepare($query_rendez_vous0);
        $stmt_a->bind_param("si",$datA, $idP);
        if ($stmt->execute() && $stmt_a->execute()) {
            // Redirige avec un message de succès
            header("Location: ../rdv/Gest_RDV.php?success=Rendez-vous ajouté avec succès");
            exit();
        } else {
            echo "<script>window.alert('Erreur : Impossible de sauvegarder le rendez-vous.')</script>";
        }
    }
}



