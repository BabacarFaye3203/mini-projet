<?php
session_start();
@include '../database/DatabaseCreat.php';

include '../configuration/headPatient.php';

if (isset($_POST['RDV'])) {
    $idM = $_SESSION['idM_Medecin'];
    $idP=$_POST["idP"];
    header("Location: formulaire_rdvP.php?idP=".$idP);
    //echo "Tres bien";
    exit();

}
?>
<?php
include '../configuration/pied.php';
?>
