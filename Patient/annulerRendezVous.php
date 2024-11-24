<?php
session_start();
include 'database/connexion_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $idR_RendezVous = $_POST['idR_RendezVous'];

    $query = "DELETE FROM rendezvous WHERE idR_RendezVous = $idR_RendezVous AND idP_Patient = $idP_Patient";
    mysqli_query($connect, $query);

    header("Location: profilPatient.php");
    exit();
}
?>
<?php
include '../configuration/headPatient.php';

include '../configuration/pied.php';

?>
