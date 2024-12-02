<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le medecin est connecté
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['idM_Medecin'];
//******************************************************************************************
$req="SELECT idP_Patient,nomP_Patient as n,prenomP as p,
       emailP as e,ageP FROM `patient` ";
$stmt = $connect->prepare($req);
$stmt->execute();
$result0 = $stmt->get_result();
//******************************************************************************************
$req="SELECT nomM_Medecin as nom,prenomM_Medecin as pre,emailM_Medecin as email,
       age,contactM_Medecin as tel,villeM_Medecin as ville,
       paysM_Medecin as pays,adresseM_Medecin as addr,matriculeM_Medecin as code,
       specialite_Medecin as spe,sexe_Medecin as sex,password as pwd
FROM medecin WHERE idM_Medecin= ? ";
$stmt0 = $connect->prepare($req);
$stmt0->bind_param("i", $idM_Med);
$stmt0->execute();
$res=$stmt0->get_result();
//******************************************************************************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP as idP
          FROM rdv_commun rdv
          JOIN patient p ON rdv.idP = p.idP_Patient
          WHERE rdv.idM = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
//*******************************************************************************************
?>
<?php //include '../configuration/headPatient.php';
    include '../configuration/head.php';
;?>
<h1>Bienvenue, Dr. <span style="font-family: 'Copperplate Gothic Bold',serif ;"><?php echo $_SESSION['nomM_Medecin']." ".$_SESSION['prenomM_Medecin']?></span></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0% 200px ;
                margin:8% 23px 10% auto ;'>";?>
<h1>Liste des patients</h1>
<?php if($result0->num_rows > 0) { ?>
    <table class='table' style="margin: 0 15px 0 0 ;">
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Email</th><th>Âge</th><th>Action</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result0->fetch_assoc()) { $i++;
            echo "<tr>
                <td> $i</td>";?>
            <td><?= htmlspecialchars($row['n']); ?></td>
            <td><?= htmlspecialchars($row['p']); ?></td>
            <td><?= htmlspecialchars($row['e']); ?></td>
            <td><?= htmlspecialchars($row['ageP']); ?></td>
            <td><form action="rdv/planifier_rendezVous.php" method="post" style="display: inline;">
                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                    <input type="submit" class="btn btn-info" name="RDV" value="Voir le profile">
                </form>
            </td>
            <?php echo "</tr>";?>
        <?php } ?>
    </table>
<?php }?>
<h1>Mes patients</h1>
<?php if($result->num_rows > 0) { ?>
    <table class='table' style="margin: 0 15px 0 0 ;">
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Email</th><th>Action</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result->fetch_assoc()) { $i++;
            echo "<tr>
                <td> $i</td>";?>
                <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                <td><?= htmlspecialchars($row['pren']); ?></td>
                <td><?= htmlspecialchars($row['mail']); ?></td>
                <td><form action="rdv/planifier_rendezVous.php" method="post" style="display: inline;">
                        <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                        <input type="submit" class="btn btn-info" name="RDV" value="Voir le profile">
                    </form>
                </td>

            <?php echo "</tr>";?>
        <?php } ?>
    </table>
<?php } else { ?>
    <p class="text-center text-muted " style="background-color: red; font-size: x-large" >VOUS N'AVEZ AUCUN PATIENT</p>
<?php } ?>
<!-- Modifier les informations personnelles du patient -->
<a href="profile.php"><h3>PROFILE</h3></a>
<a href="#"><h4>Documents</h4></a>
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
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
</form>
<!-- Gestion des rendez-vous -->

<a href="rdv/Gest_RDV.php"><h3>Mes rendez-vous</h3></a>

<?php echo "</div>"?>
<?php
?>
<?php
include '../configuration/pied.php';
?>


