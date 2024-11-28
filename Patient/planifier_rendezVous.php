<?php
session_start();
@include '../database/DatabaseCreat.php';

include '../configuration/headPatient.php';
if (isset($_POST['RDV'])) {
    $idM = $_SESSION['idP_Patient'];
    $idM=$_POST["idM"];
    header("Location: formulaire_rdvM.php?idM=".$idM);
    exit();
}
?>
<?php
include '../configuration/pied.php';
?>