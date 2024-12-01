<?php 
session_start();
include '../database/DatabaseCreat.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idM = $_SESSION['idM_Medecin'];
    $email = $_POST['email'];
    $vi = $_POST['ville'];
    $p = $_POST['pays'];
    $add = $_POST['adr'];
    $cod = $_POST['cod'];
    $age = $_POST['age'];
    $tel = $_POST['tel'];
    $pwd = $_POST['pwd']; // Assurez-vous que "pwd" représente une colonne dans votre table

    $query = "UPDATE medecin 
              SET emailM_Medecin = ?, adresseM_Medecin = ?, paysM_Medecin = ?, 
                  villeM_Medecin = ?, contactM_Medecin = ?, age = ?, matriculeM_Medecin = ?          
              WHERE idM_Medecin = ?";
    $stmt = $connect->prepare($query);
    //$connect->query($query);
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssssisss", $email, $add, $p, $vi, $tel, $age, $cod, $idM);
    $stmt->execute();
    header("Location: profilMed.php");
    exit();
}
?>

<?php
include '../configuration/patient/headPatient.php';

include '../configuration/patient/piedPatient.php';
?>

