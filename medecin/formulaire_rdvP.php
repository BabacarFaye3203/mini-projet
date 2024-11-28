<?php
session_start();
@include '../database/DatabaseCreat.php';
$idP = $_GET['idP'];
$query = "SELECT nomP_Patient, emailP FROM patient WHERE idP_Patient = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP);
$stmt->execute();
$result = $stmt->get_result();
$patient= $result->fetch_assoc();
?>
<?php
include '../configuration/headPatient.php';
?>
<h1>Bienvenue, <?php echo $patient['nomP_Patient']." ".$patient['prenomP']; ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="deconnexion.php">Medecin</a></li>
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
<h2>Prendre rendez-vous avec Mr/Mme <?= htmlspecialchars($patient['nomP_Patient']); ?></h2>
<form action="enreg_rdv.php" method="post" >
    <input type="hidden" name="idP" value="<?= $idP; ?>">
    <div class="mb-3">
    <label class="form-label" for="date">Date et heure :</label>
    <input class="form-label" type="datetime-local" id="date" name="date_rdv" required>
    </div>
    <div class="mb-3">
    <label class="form-label" for="motif">Motif</label>
    <input class="form-label" type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required>
    </div>
    <button type="submit" class="form-label btn btn-primary">Confirmer</button>
</form>
<?php
include '../configuration/pied.php';
?>

