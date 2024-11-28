<?php
session_start();
include '../database/DatabaseCreat.php';

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $date = $_POST['dateR_RendezVous'];
    $type = $_POST['type_RendezVous'];
    $idM_Medecin=$_POST["idM"];
    $query = "INSERT INTO rendezvous (idR_RendezVous, dateR_RendezVous, type_RendezVous,idP_Patient,idM_Medecin) VALUES ($idP_Patient, '$date', '$type',$idM_Medecin)";
    mysqli_query($connect, $query);

    header("Location: profilPatient.php");
    exit();
}*/

/*
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
}
*/

?>
<?php
include '../configuration/headPatient.php';
include '../configuration/pied.php';
?>