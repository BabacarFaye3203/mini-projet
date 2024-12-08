<?php
include 'database/DatabaseCreat.php';

$nom = isset($_POST['nomP']) ? htmlspecialchars($_POST['nomP']) :'';
$prenom = isset($_POST['prenomP']) ? htmlspecialchars($_POST['prenomP']) : '';
$adresse = isset($_POST['adresseP']) ? htmlspecialchars($_POST['adresseP']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$pays = isset($_POST['paysP']) ? htmlspecialchars($_POST['paysP']) : '';
$ville = isset($_POST['villeP']) ? htmlspecialchars($_POST['villeP']) : '';
$groupe_sanguin = isset($_POST['groupe_sanguin_Patient']) ? htmlspecialchars($_POST['groupe_sanguin_Patient']) : '';
$situation_matri = isset($_POST['situation_matri_Patient']) ? htmlspecialchars($_POST['situation_matri_Patient']) : '';
$profession = isset($_POST['profession_Patient']) ? htmlspecialchars($_POST['profession_Patient']) : '';
$statut = isset($_POST['statut_Patient']) ? htmlspecialchars($_POST['statut_Patient']) : '';
$age = isset($_POST['ageP']) ? htmlspecialchars($_POST['ageP']) : '';
$sexe = isset($_POST['sexeP']) ? htmlspecialchars($_POST['sexeP']) : '';
$poids = isset($_POST['poids_Patient']) ? htmlspecialchars($_POST['poids_Patient']) : '';
$taille = isset($_POST['taille_Patient']) ? htmlspecialchars($_POST['taille_Patient']) : '';
$contact = isset($_POST['contactP']) ? htmlspecialchars($_POST['contactP']) : '';
$CIN = isset($_POST['CIN_Patient']) ? htmlspecialchars($_POST['CIN_Patient']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

// Préparation de la requête SQL
$sql = "INSERT INTO Patient (nomP_Patient, prenomP, adresseP, email, paysP, villeP, groupe_sanguin_Patient, situation_matri_Patient, profession_Patient, statut_Patient, ageP, sexeP, poids_Patient, taille_Patient, contactP, CIN_Patient, password) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connect->prepare($sql);
$stmt->bind_param(
    "ssssssssssisddsss",
    $nom,
    $prenom,
    $adresse,
    $email,
    $pays,
    $ville,
    $groupe_sanguin,
    $situation_matri,
    $profession,
    $statut,
    $age,
    $sexe,
    $poids,
    $taille,
    $contact,
    $CIN,
    $password
);

if ($stmt->execute()) {
    echo "Patient ajouté avec succès !";
} else {
    echo "Erreur : " . $stmt->error;
}

// Fermeture de la connexion
$stmt->close();
$connect->close();