<?php
@include '../database/DatabaseCreat.php';
$idM = $_GET['idM'];

$query = "SELECT nomM_Medecin, emailM_Medecin FROM medecin WHERE idM_Medecin = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM);
$stmt->execute();
$result = $stmt->get_result();
$med= $result->fetch_assoc();
?>
<h2>Prendre rendez-vous avec Dr. <?= htmlspecialchars($med['nomM_Medecin']); ?></h2>
<form action="enreg_rdvM.php" method="post" >
    <input type="hidden" name="idM" value="<?= $idM; ?>">
    <label for="date">Date et heure :</label>
    <input type="datetime-local" id="date" name="date_rdv" required>
    <label for="motif">Motif</label>
    <input type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required>
    <button type="submit" class="btn btn-primary">Confirmer</button>
</form>

