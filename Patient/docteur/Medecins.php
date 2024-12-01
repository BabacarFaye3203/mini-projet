<?php
session_start();

include '../../database/DatabaseCreat.php';

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
<?php include '../../configuration/patient/headPatient.php';
//include '../Patient/docteur/configuration/headPatient.php';
?>

<h1>Ici vous consultez tous les medecins ou vos medecins et pourrez prendre des rendez-vous</h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0 200px ;
                margin:8% 23px 10% auto ;'>";?>
<h2>Liste des medecins</h2>
<?php if($result0->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Spécialité</th><th>Action</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result0->fetch_assoc()) { $i++;
            echo "<tr>
                <td> $i</td>";?>
            <td><?= htmlspecialchars($row['n']); ?></td>
            <td><?= htmlspecialchars($row['p']); ?></td>
            <td><?= htmlspecialchars($row['sp']); ?></td>
            <td><form action="../rdv/planifier_rendezVous.php" method="post" style="display: inline;">
                    <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                    <input type="submit" class="btn btn-info" name="RDV" value="Voir profiles">
                </form>
            </td>
            <?php echo "</tr>"?>
        <?php } ?>
    </table>
<?php }?>
<h2>Mes medecins</h2>
<?php if($result->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Spécialité</th><th>Email</th><th>Action</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result->fetch_assoc()) { $i++;
            echo "<tr>
                <td> $i</td>";?>
            <td><?= htmlspecialchars($row['nomMed']); ?></td>
            <td><?= htmlspecialchars($row['pren']); ?></td>
            <td><?= htmlspecialchars($row['spe']); ?></td>
            <td><?= htmlspecialchars($row['mail']); ?></td>
            <td><form action="../rdv/planifier_rendezVous.php" method="post" style="display: inline;">
                    <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                    <input type="submit" class="btn btn-info" name="RDV" value="Voir profile">
                </form>
            </td>
            <?php echo "</tr>"?>
        <?php } ?>
    </table>
<?php } else { ?>
    <p class="text-center text-muted " style="background-color: red; font-size: x-large" >VOUS N'AVEZ AUCUN MEDECINT</p>
<?php } ?>

<!-- Modifier les informations personnelles du patient -->
<?php echo "</div>"?>
<?php
include '../../configuration/patient/piedPatient.php';
?>


