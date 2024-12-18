<?php
include 'database/DatabaseCreat.php';

$nom = isset($_POST['nomP']) ? htmlspecialchars($_POST['nomP']):'champ doit etre renseigné';
$prenom = isset($_POST['prenomP']) ? htmlspecialchars($_POST['prenomP']) : 'champ doit etre renseigné';
$adresse = isset($_POST['adresseP']) ? htmlspecialchars($_POST['adresseP']) : 'champ doit etre renseigné';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'champ doit etre renseigné';
$pays = isset($_POST['paysP']) ? htmlspecialchars($_POST['paysP']) : 'champ doit etre renseigné';
$ville = isset($_POST['villeP']) ? htmlspecialchars($_POST['villeP']) :'champ doit etre renseigné';
$groupe_sanguin = isset($_POST['groupe_sanguin_Patient']) ? htmlspecialchars($_POST['groupe_sanguin_Patient']) : 'champ doit etre renseigné';
$situation_matri = isset($_POST['situation_matri_Patient']) ? htmlspecialchars($_POST['situation_matri_Patient']) : 'champ doit etre renseigné';
$profession = isset($_POST['profession_Patient']) ? htmlspecialchars($_POST['profession_Patient']) : 'champ doit etre renseigné';
$statut = isset($_POST['statut_Patient']) ? htmlspecialchars($_POST['statut_Patient']) : 'champ doit etre renseigné';
$age = isset($_POST['ageP']) ? htmlspecialchars($_POST['ageP']) : 'champ doit etre renseigné';
$sexe = isset($_POST['sexeP']) ? htmlspecialchars($_POST['sexeP']) : 'champ doit etre renseigné';
$poids = isset($_POST['poids_Patient']) ? htmlspecialchars($_POST['poids_Patient']) : 'champ doit etre renseigné';
$taille = isset($_POST['taille_Patient']) ? htmlspecialchars($_POST['taille_Patient']) : 'champ doit etre renseigné';
$contact = isset($_POST['contactP']) ? htmlspecialchars($_POST['contactP']) : 'champ doit etre renseigné';
$CIN = isset($_POST['CIN_Patient']) ? htmlspecialchars($_POST['CIN_Patient']) : 'champ doit etre renseigné';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : 'champ doit etre renseigné';

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