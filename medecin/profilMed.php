<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['idM_Medecin'];

$req="SELECT * FROM `medecin` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $med=  $stmt->fetch();
}
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php include '../configuration/headPatient.php';?>

<h1>Bienvenue, <?php echo $_SESSION['nomM_Medecin']; ?></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Liste des patients</h1>
<?php if($result->num_rows > 0) { ?>
    <table class='table'>
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
                <td><form action="planifier_rendezVous.php" method="post" style="display: inline;">
                        <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                        <input type="submit" name="RDV" value="Prendre rendez-vous">
                    </form>
                </td>
            </tr>
            }
        <?php } ?>
    </table>
<?php }else{?>
   <?php if (isset($_POST['cin'])){
    $cin=strip_tags(trim($_POST['cin']));
    $query1 = "SELECT idP_Patient,nomP_Patient as nom,prenomP as prenom, CIN_Patient, emailP as email
    FROM patient as p
    WHERE CIN_Patient = ?
    ";
    $stmt1 = $connect->prepare($query1);
    $stmt1->bind_param("s", $cin);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
if($result1->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Action</th></tr>
        </thead>
        <?php $row1 = $result1->fetch_assoc()?>
            <tr>
                <td><?= htmlspecialchars($row1['nom']); ?></td>
                <td><?= htmlspecialchars($row1['prenom']); ?></td>
                <td><?= htmlspecialchars($row1['email']); ?></td>
                <td><form action="planifier_rendezVous.php" method="post" style="display: inline;">
                        <input type="hidden" name="idP" value="<?= $row1['idP_Patient']; ?>">
                        <input type="submit" name="RDV" value="Prendre rendez-vous">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php }
}?>

    <h1>Ajouter un nouveau patient</h1>
    <form class="form-control" action="profilMed.php" method="post">
        <label for="cin">Saisir son CIN</label>
        <input type="search" id="cin" name="cin" placeholder="saisir son CIN">
    </form>
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
<!-- Gestion des rendez-vous -->

<a href="voirPatient.php"><h3>Mes rendez-vous</h3></a>
<?php if($result->num_rows > 0) {$i=1; ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Date de RENDEZ-VOUS</th><th>Details</th></tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) {?>
            <tr>
                <td><?php $i ?></td>
                <td><?= htmlspecialchars($row['nomMed']); ?></td>
                <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                <td><form action="voirPatient.php" method="post" style="display: inline;">
                        <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                        <button type="submit">Details</button>
                    </form>
                </td>
            </tr>
        <?php $i++; } ?>
    </table>
<?php }?>
<?php
/*
$idM_Med = $_SESSION['id_Medecin'];
$req="SELECT * FROM `patient` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $med=  $stmt->fetch();
}

$rq = "SELECT * FROM rendezvous WHERE idM_Medecin = $idM_Med";
$rdv_result = mysqli_query($connect, $rq);

while ($rdv = mysqli_fetch_assoc($rdv_result)) {
    echo "<div>";
    echo "Date : " . @$rdv['dateR_RendezVous'] . "   type : " . @$rdv['type_RendezVous'];
    echo "<form action='../Patient/annulerRendezVous.php' method='POST'>
            <div class='mb-3'>
                <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
            </div>
            </form>";
}

*/
/*
$result = $connect->query("
    SELECT rendezvous.idP_Patient, rendezvous.nomP_Patient as nomPatient, patient.emailP 
    FROM rendezvous
    JOIN medecin ON patient.idM_Medecin = patient.idP_Patient
    WHERE medecin.idM_Medecin = $idM_Med;
");
*/
?>
<?php
include '../configuration/pied.php';
?>


