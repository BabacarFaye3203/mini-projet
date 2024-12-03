<?php
session_start();
include '../database/DatabaseCreat.php'; // Connexion à la base de données

//  si les données ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
} else {
    echo "<script>window.alert('Méthode non autorisée. ')</script>";
}

