<?php
session_start();
@include '../database/DatabaseCreat.php';

include '../configuration/headPatient.php';

if (isset($_POST['RDV'])) {
    $idM = $_SESSION['idM_Medecin'];
    //$date = $_POST['dateR_RendezVous'];
    //$type = $_POST['type_RendezVous'];
    $idP=$_POST["idP"];
    //$query = "INSERT INTO rendezvous (idR_RendezVous, dateR_RendezVous, type_RendezVous,idP_Patient,idM_Medecin) VALUES ($idP_Patient, '$date', '$type',$idM_Medecin)";
   // mysqli_query($connect, $query);

    header("Location: formulaire_rdvP.php?idP=".$idP);
    echo "Tres bien";
    exit();

}else{
    echo "Impossible";
}
/*$patient_id = $_SESSION['idP_Patient'];
$medecin_id = $_POST['medecin_id'];
$date_rendez_vous = $_POST['date_rendez_vous'];
$description = $_POST['description'];
// Validation des données...
$query = "INSERT INTO rendezvous (dateR_RendezVous, type_RendezVous, idP_Patient, idM_Medecin)
          VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param("ssii", $patient_id, $medecin_id, $date_rendez_vous, $description);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    echo "Rendez-vous ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout du rendez-vous.";
}*/
?>
<?php
include '../configuration/pied.php';
?>
