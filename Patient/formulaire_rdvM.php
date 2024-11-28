<?php
@include '../database/DatabaseCreat.php';
$idM = $_GET['idM'];
$req="SELECT idM_Medecin,nomM_Medecin as n,prenomM_Medecin as p,emailM_Medecin as e,
       specialite_Medecin as sp,contactM_Medecin as c,sexe_Medecin as s, age FROM `medecin` where idM_Medecin=?";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM);
$stmt->execute();
$result0 = $stmt->get_result();
$med= $result0->fetch_assoc();
?>

<h2>Prendre rendez-vous avec Dr. <?= htmlspecialchars($med['n']); ?></h2>
<h2>Informations sur le medecin</h2>
<?php if ($med){ ?>
<p><strong>Nom :</strong> <?= htmlspecialchars($med['n']); ?></p>
<p><strong>Prénom :</strong> <?= htmlspecialchars($med['p']); ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($med['e']); ?></p>
<p><strong>Specialite :</strong> <?= htmlspecialchars($med['sp']); ?></p>
<p><strong>Contact :</strong> <?= htmlspecialchars($med['c']); ?></p>
<p><strong>Sexe :</strong> <?= htmlspecialchars($med['s']); ?></p>
<p><strong>Age :</strong> <?= htmlspecialchars($med['age']); ?></p><br>
<form action="enreg_rdvM.php" method="post" >
    <input type="hidden" name="idM" value="<?= $idM; ?>">
    <label for="date">Date et heure :</label>
    <input type="datetime-local" id="date" name="date_rdv" required>
    <label for="motif">Motif</label>
    <input type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required>
    <button type="submit" class="btn btn-primary">Confirmer</button>
</form>
<?php }?>