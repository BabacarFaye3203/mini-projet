<?php
session_start();
include '../database/DatabaseCreat.php'; // Connexion à la base de données


// Vérifie si les données ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idM = $_SESSION['id_Medecin']; // ID du medecin connecté
    $idP = $_POST['idP']; // ID du patient sélectionné
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $motif=$_POST['motif'];//moitif du rdv
    $lieu = $_POST['Lieu'];
    if (!empty($idP) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous,idP_Patient,idM_Medecin,lieu ) VALUES (?, ?, ?,?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssiis", $date_rdv,$motif,$idP,$idM,$lieu);
        $query_insert = "INSERT INTO rdv_commun (idP, idM)
        SELECT ?, ?
        WHERE NOT EXISTS (
            SELECT 1 FROM rdv_commun WHERE idP = ? AND idM = ?
        )";
        $stmt_insert = $connect->prepare($query_insert);
        $stmt_insert->bind_param("iiii", $idP, $idM, $idP, $idM);
        if ($stmt->execute() && $stmt_insert->execute()) {
            // Redirige avec un message de succès
            header("Location: ../profilMed.php?success=Rendez-vous ajouté avec succès");
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


//  si les données ont été soumises
/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idM = $_SESSION['idM_Medecin']; // ID du medecin connecté
    $idP = $_POST['idP']; // ID du patient sélectionné
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $motif=$_POST['motif'];//moitif du rdv
    if (!empty($idP) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient,idM_Medecin) VALUES (?, ?, ?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssii", $date_rdv,strip_tags($motif),$idP,$idM);

        if ($stmt->execute()) {
            // Redirige avec un message de succès
            header("Location: profilMed.php?success=Rendez-vous ajouté avec succès");
            exit();
        } else {
            echo "<script>window.alert('Erreur : Impossible de sauvegarder le rendez-vous.')</script>";
        }
    } else {
        echo "<script>window.alert('Veuillez remplir tous les champs.')</script> ";
    }
}*/


