<?php
@include '../../database/DatabaseCreat.php';
$idM = $_GET['idM'];
$req="SELECT idM_Medecin,nomM_Medecin as n,prenomM_Medecin as p,emailM_Medecin as e,
       specialite_Medecin as sp,contactM_Medecin as c,sexe_Medecin as s, age FROM `medecin` where idM_Medecin=?";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM);
$stmt->execute();
$result0 = $stmt->get_result();
$med= $result0->fetch_assoc();
?>
<?php include '../../configuration/patient/headPatient.php';
;?>
<div style='padding:0 0 0 15% ;margin:8% 23px 10% auto ;'>
<h2>Informations sur le medecin</h2>
<?php if ($med){ ?>

    <div class="card" style="width: 20rem;margin:8% 500px 1% auto ; ">
        <img src="img.jpg" class="card-img-top"  >
        <div class="card-body">
            <h6 class="card-title"><?= htmlspecialchars($med['n']); ?> <?= htmlspecialchars($med['p']); ?> </h6>
            <p class="card-text"><p><strong>Âge :</strong> <?= htmlspecialchars($med['age']); ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($med['e']); ?></p>
        </div>
    </div>
    <p><strong>Spécialité :</strong> <?= htmlspecialchars($med['sp']); ?></p>
    <p><strong>Contact :</strong> <?= htmlspecialchars($med['c']); ?></p>
    <p><strong>Sexe :</strong> <?= htmlspecialchars($med['s']); ?></p>
    <p><strong>Age :</strong> <?= htmlspecialchars($med['age']); ?></p><br>
    <h2>Prendre rendez-vous avec Dr. <?= htmlspecialchars($med['n']); ?></h2>
<form action="enreg_rdvM.php" method="post" style="padding: 0 85% 0 0">
    <input type="hidden" name="idM" value="<?= $idM; ?>">
    <div class="mb-3">
        <label class="form-label" for="date">Date et heure :</label>
        <input class="form-label" type="datetime-local" id="date" name="date_rdv" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="motif">Motif</label>
        <input class="form-label" type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="lieu">Lieu</label>
        <input class="form-label" type="text" name="lieu" id="lieu"  required>
    </div>
    <button type="submit" class="btn btn-primary">Confirmer</button>
</form>
</div>
<?php }?>
<?php
include '../../configuration/patient/piedPatient.php';
?>
