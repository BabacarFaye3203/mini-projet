<?php
session_start();
include '../database/connexion_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $date = $_POST['dateR_RendezVous'];
    $type = $_POST['type_RendezVous'];
    $idM_Medecin=$_POST["idM"];

    $query = "INSERT INTO rendezvous (idR_RendezVous, dateR_RendezVous, type_RendezVous,idP_Patient,idM_Medecin) VALUES (?,$$idP_Patient, '$date', '$type',$idM_Medecin)";
    mysqli_query($connect, $query);

    header("Location: profilPatient.php");
    exit();
}
?>
<?php

include '../configuration/headPatient.php';


include '../configuration/pied.php';
?>
