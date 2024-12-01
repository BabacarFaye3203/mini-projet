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
<?php //include '../configuration/headPatient.php';
include '../configuration/head.php';
?>

<h1>Bienvenue, <?php echo $_SESSION['nomP_Patient']; ?></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0 200px ;
                margin:8% 23px 10% auto ;'>";?>
<!-- Modifier les informations personnelles du patient -->
<h1>Modifier votre profil</h1>
<form action="../Patient/modificationProfil.php" method="POST">
    <input type="text" name="nom" value="<?php echo $_SESSION['nomM_Medecin']; ?>" required>
    <input type="email" name="email" value="<?php echo $med['emailM_Medecin']; ?>" required>
    <button type="submit">Mettre à jour</button>
</form>
<?php echo "</div>"?>
<?php
include '../configuration/pied.php';
?>


