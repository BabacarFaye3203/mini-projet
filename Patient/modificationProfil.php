<?php 
session_start();
include '../database/DatabaseCreat.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idM_Medecin'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $query = "UPDATE patient SET nomP_Patient = '$nom', emailP = '$email' WHERE idP_Patient = $idP_Patient";
    mysqli_query($connect, $query);

    header("Location: profilPatient.php");
    exit();
}
?>

<?php
include '../configuration/headPatient.php';

include '../configuration/pied.php';
?>

