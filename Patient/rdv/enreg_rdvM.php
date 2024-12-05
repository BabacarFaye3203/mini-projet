<?php
session_start();
include '../../database/DatabaseCreat.php'; // Connexion à la base de données

// Vérifie si les données ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP = $_SESSION['idP_Patient']; // ID du patient connecté
    $idM = $_POST['idM']; // ID du medecin sélectionné
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $motif=strip_tags(trim($_POST['motif']));//motif du rdv
    $lieu=$_POST['lieu'];
    if (!empty($idM) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient,idM_Medecin,lieu,statut) VALUES (?, ?, ?,?,?,'soumis')";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssiis",$date_rdv,$motif,$idP,$idM);
        //Insertion pour pouvoir afficher les patients de chaque medecin
        $query_insert = "INSERT INTO rdv_commun (idP,idM)
        SELECT ?, ? from dual
        WHERE NOT EXISTS (
            SELECT 1 FROM rdv_commun WHERE idP = ? and idM = ?
        )";
        $stmt_insert = $connect->prepare($query_insert);
        $stmt_insert->bind_param("iiii",$idP,$idM,$idP,$idM);

        if ($stmt->execute() && $stmt_insert->execute()) {
            // Redirige avec un message de succès
            header("Location: ../profilPatient.php?success=Rendez-vous ajouté avec succès");
            exit();
        } else {
            echo "<script>window.alert('Erreur : Impossible de sauvegarder le rendez-vous.')</script>";
        }
    } else {
        echo "<script>window.alert('Veuillez remplir tous les champs.')</script> ";
    }
} else {
    echo "<script>window.alert('Méthode non autorisée. ')</script>";
}

