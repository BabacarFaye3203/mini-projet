<?php
session_start();
include '../database/DatabaseCreat.php'; // Connexion à la base de données

// Vérifie si les données ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP = $_SESSION['idP_Patient']; // ID du patient connecté
    $idM = $_POST['idM']; // ID du medecin sélectionné
    $date_rdv = $_POST['date_rdv']; // Date et heure du rdv
    $motif=$_POST['motif'];//moitif du rdv
    if (!empty($idM) && !empty($date_rdv) && !empty($motif)) {
        // Insertion dans la table des rendez-vous
        $query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient,idM_Medecin) VALUES (?, ?, ?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssii", $date_rdv,strip_tags($motif),$idP,$idM);

        if ($stmt->execute()) {
            // Redirige avec un message de succès
            header("Location: profilPatient.php?success=Rendez-vous ajouté avec succès");
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
