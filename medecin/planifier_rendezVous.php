<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le medecin est connecté
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

// Récup l'ID du patient à partir de l'URL
if (isset($_POST['idP'])) {
    $idP = $_POST['idP'];
} else {
    echo "Aucun patient sélectionné.";
    exit();
}

// Récup les informations du patient
$queryPatient = "SELECT nomP_Patient, prenomP, emailP FROM patient WHERE idP_Patient = ?";
$stmtPatient = $connect->prepare($queryPatient);
$stmtPatient->bind_param("i", $idP);
$stmtPatient->execute();
$resultPatient = $stmtPatient->get_result();
if ($resultPatient->num_rows > 0) {
    $patient = $resultPatient->fetch_assoc();
} else {
    echo "Patient non trouvé.";
    exit();
}

// Planif un rendez-vous
if (isset($_POST['planifier_rdv'])) {
    $dateRdv = $_POST['dateRdv'];
    $typeRdv = $_POST['typeRdv'];
    $lieu = $_POST['LieuRdv'];
    $queryInsert = "INSERT INTO RendezVous (dateR_RendezVous, type_RendezVous, idP_Patient, idM_Medecin,Lieu) VALUES (?, ?, ?, ?,?)";
    $stmtInsert = $connect->prepare($queryInsert);
    $stmtInsert->bind_param("ssiis", $dateRdv, $typeRdv, $idP, $_SESSION['id_Medecin'],$lieu);
    $stmtInsert->execute();
    
    echo "<p>Le rendez-vous a été planifié avec succès.</p>";
}

?>

<?php
// en-tête de la page
include '../configuration/headMedsous.php';
?>

<h1>Planifier un rendez-vous pour <?= htmlspecialchars($patient['nomP_Patient']) . " " . htmlspecialchars($patient['prenomP']); ?></h1>
<h1>Bienvenue, <?php echo $patient['nomP_Patient']." ".$patient['prenomP']; ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="../deconnexion.php">Medecin</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
        </div>
      </div>
    </div>
  </div>


<form action="planifier_rendezvous.php" method="post">
    <input type="hidden" name="idP" value="<?= $idP; ?>">
    <div class="mb-3">
        <label for="dateRdv" class="form-label">Date et heure du rendez-vous</label>
        <input type="datetime-local" id="dateRdv" name="dateRdv" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="typeRdv" class="form-label">Type de rendez-vous</label>
        <input type="text" id="typeRdv" name="typeRdv" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="typeRdv" class="form-label">Lieu de rendez-vous</label>
        <input type="text" id="LieuRDV" name="LieuRdv" class="form-control" required>
    </div>
    <button type="submit" name="planifier_rdv" class="btn btn-primary">Planifier le rendez-vous</button>
</form>

<?php

//pied de page
include '../configuration/pied.php';
include '../configuration/footer.php';
?>
