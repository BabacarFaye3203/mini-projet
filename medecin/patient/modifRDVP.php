<?php session_start();
include '../../database/DatabaseCreat.php';

if (isset($_POST['modifier'])) {
$idM = $_SESSION['idM_Medecin'];
$date_rdv = $_POST['date_rdv'] ;
$lieu = $_POST['lieu'] ;
$idr = $_POST['idr'] ;

if (!empty($date_rdv) && !empty($lieu) && !empty($idr)) {
$query = "UPDATE rendezvous SET dateR_RendezVous=?, lieu=?, statut='reprogrammé' WHERE idR_RendezVous=?";
$stmt = $connect->prepare($query);
$stmt->bind_param("ssi", $date_rdv, $lieu, $idr);

if ($stmt->execute()) {
header("Location: ../rdv/Gest_RDV.php?success=Rendez-vous modifié avec succès");
exit();
} else {
echo "Erreur : Impossible de mettre à jour le rendez-vous.";
}
} else {
echo "Veuillez remplir tous les champs.";
}
}
