<?php 
session_start();
include '../database/connexion_db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $query = "UPDATE patient SET nom = '$nom', email = '$email' WHERE idP_Patient = $idP_Patient";
    mysqli_query($connect, $query);

    header("Location: profilPatient.php");
    exit();
}
?>

<?php
include '../configuration/headPatient.php';

include '../configuration/pied.php';
?>