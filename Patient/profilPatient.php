<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si le patient est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../conPatient.php");
    exit();
}

$idP_Patient = $_SESSION['idP_Patient'];

$req="SELECT idM_Medecin,nomM_Medecin as n,prenomM_Medecin as p,
       specialite_Medecin as sp FROM `medecin` ";
$stmt = $connect->prepare($req);
$stmt->execute();
$result0 = $stmt->get_result();
//***********************************************************************************
$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.specialite_Medecin as spe,
       m.emailM_Medecin as mail,m.prenomM_Medecin as pren,rdv.idM as idM
          FROM rdv_commun rdv
          JOIN medecin m ON rdv.idM = m.idM_Medecin
          WHERE rdv.idP = ?
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP_Patient);
$stmt->execute();
$result = $stmt->get_result();
//***********************************************************************************
?>
<?php include '../configuration/patient/headPatient.php';
//include '../configuration/head.php';
?>

<h1>Bienvenue, <?php echo $_SESSION['nomP_Patient']; ?></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0 200px ;
                margin:8% 23px 10% auto ;'>";?>
<a href="docteur/Medecins.php" style="text-underline: none"><h1>MEDECINS</h1></a>
<!-- Modifier les informations personnelles du patient -->
<a href="profile.php" style="text-underline: none"><h1 style="text-underline: none">PROFILE</h1></a>
<a href="doc/documents.php" style="text-underline: none"><h1 style="text-underline: none">DOCUMENTS</h1></a>
<a href="rdv/Gest_RDVMed.php" style="text-underline: none"><h1 style="text-underline: none">MES RENDEZ-VOUS</h1></a>
<?php echo "</div>"?>
<?php
include '../configuration/patient/piedPatient.php';
?>


