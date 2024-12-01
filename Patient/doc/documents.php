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
;?>

<h1>Ici vous pouvez consultez vos documents ou les ajouter </h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0% 200px ;
                margin:8% 23px 10% auto ;'>";?>
<h2>Historique medical</h2>
<form action="/Patient/ajouter_document.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3 container">
        <div class="form-floating mb-3">
            <select name="type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected>Choisir</option>
                <option value="Consultation">Consultation</option>
                <option value="Résultats d'examen">Résultats d'examen</option>
                <option value="Autre">Autre</option>
            </select>
            <label for="floatingSelect">Type de document</label>
        </div>
        <input type="file" class="form-control"  name="document" required>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
<?php echo "</div>"?>
<?php
include '../configuration/pied.php';
?>


