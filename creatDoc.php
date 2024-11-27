<?php
session_start();
$dossier = 'uploads'; // Nom du dossier ou seront déplacés les documents du patient

// Vérifier si le dossier n'existe pas déjà
if (!is_dir($dossier)) {
    // Créer le dossier avec des permissions (lecture, écriture, exécution)
    if (mkdir($dossier, 0777, true)) {
        echo "Dossier '$dossier' créé avec succès.";
    } else {
        echo "Échec de la création du dossier '$dossier'.";
    }
} else {
    echo "Le dossier '$dossier' existe déjà.";
}
?>
