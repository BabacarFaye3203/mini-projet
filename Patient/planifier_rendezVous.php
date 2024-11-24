<?php
session_start();
include '../database/connexion_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $date = $_POST['dateR_RendezVous'];
    $type = $_POST['type_RendezVous'];

    $query = "INSERT INTO rendezvous (idP_Patient, dateR_RendezVous, type_RendezVous) VALUES ($$idP_Patient, '$date', '$type')";
    mysqli_query($connect, $query);

    header("Location: profil.php");
    exit();
}
?>
<?php

include '../configuration/head.php';


include '../configuration/pied.php';
?>
