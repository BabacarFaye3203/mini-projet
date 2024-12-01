<?php
session_start();
@include '../database/DatabaseCreat.php';
$idP = $_GET['idP'];
$query_patient = "SELECT nomP_Patient, prenomP, ageP, emailP,sexeP FROM patient WHERE idP_Patient = ?";
$stmt_patient = $connect->prepare($query_patient);
$stmt_patient->bind_param("i", $idP);
$stmt_patient->execute();
$result_patient = $stmt_patient->get_result();
$patient = $result_patient->fetch_assoc();
?>
<?php
include '../configuration/headPatient.php';
?>
<div style='padding:0 0 0 15% ;margin:8% 23px 10% auto ;'>

<h2>Informations sur le patient</h2>
<?php if ($patient){ ?>
    <div class="card" style="width: 20rem; ">
        <img src="img.jpg" class="card-img-top"  >
        <div class="card-body">
            <h6 class="card-title"><?= htmlspecialchars($patient['nomP_Patient']); ?> <?= htmlspecialchars($patient['prenomP']); ?> </h6>
            <p class="card-text"><p><strong>Âge :</strong> <?= htmlspecialchars($patient['ageP']); ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($patient['emailP']); ?></p></p>
            <a href="#" class="btn btn-primary">Voir le profile</a>
        </div>
    </div>
    <h2>Prendre rendez-vous avec <?php if($patient['sexeP']==='Homme'){ echo "Mr ".htmlspecialchars($patient['nomP_Patient']);}else{echo "Mme ".htmlspecialchars($patient['nomP_Patient']);} ?></h2>
<form action="enreg_rdv.php" method="post" style="padding: 0 85% 0 0" >
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
</div>
<?php }?>
<?php
include '../configuration/pied.php';
?>

