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

