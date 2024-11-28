<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si le patient est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../conPatient.php");
    exit();
}

$idP_Patient = $_SESSION['idP_Patient'];

$req="SELECT idM_Medecin,nomM_Medecin as n,prenomM_Medecin as p,emailM_Medecin as e,
       specialite_Medecin as sp,contactM_Medecin as c,sexe_Medecin as s FROM `medecin` ";
$stmt = $connect->prepare($req);
$stmt->execute();
$result0 = $stmt->get_result();

$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.specialite_Medecin as spe,m.emailM_Medecin as mail,m.prenomM_Medecin as pren,rdv.idM_Medecin as idM
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ?
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP_Patient);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php //include '../configuration/headPatient.php';
include '../configuration/head.php';
;?>

<h1>Bienvenue, <?php echo $_SESSION['nomP_Patient']; ?></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0% 200px ;
                margin:8% 23px 10% auto ;'>";?>
<h1>Liste des medecins</h1>
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
            <td><form action="planifier_rendezVous.php" method="post" style="display: inline;">
                    <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                    <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                </form>
            </td>
            </tr>
        <?php } ?>
    </table>
<?php }?>
<h1>Mes medecins</h1>
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
            <td><form action="planifier_rendezVous.php" method="post" style="display: inline;">
                    <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                    <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                </form>
            </td>
            </tr>
        <?php } ?>
    </table>
<?php }?>

<!-- Modifier les informations personnelles du patient -->
<h3>Modifier votre profil</h3>
<form action="../Patient/modificationProfil.php" method="POST">
    <input type="text" name="nom" value="<?php echo $_SESSION['nomM_Medecin']; ?>" required>
    <input type="email" name="email" value="<?php echo $med['emailM_Medecin']; ?>" required>
    <button type="submit">Mettre à jour</button>
</form>
<h4>Documents</h4>
<form action="/Patient/ajouter_document.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <input type="file" class="form-control"  name="document" required>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
</form>
<?php echo "</div>"?>
<?php
include '../configuration/pied.php';
?>


