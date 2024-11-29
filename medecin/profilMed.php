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
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
$result2=$result;
?>
<?php //include '../configuration/headPatient.php';
    include '../configuration/head.php';
;?>
<h1>Bienvenue, <?php echo $_SESSION['nomM_Medecin'] ?></h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0% 200px ;
                margin:8% 23px 10% auto ;'>";?>
<h1>Liste des patients</h1>
<?php if($result->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Email</th><th>Action</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result2->fetch_assoc()) { $i++;
            echo "<tr>
                <td> $i</td>";?>
                <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                <td><?= htmlspecialchars($row['pren']); ?></td>
                <td><?= htmlspecialchars($row['mail']); ?></td>
                <td><form action="planifier_rendezVous.php" method="post" style="display: inline;">
                        <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                        <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                    </form>
                </td>

            <?php echo "</tr>";?>
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
                        <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php }
}?>

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

<a href="Gest_RDV.php"><h3>Mes rendez-vous</h3></a>

<?php echo "</div>"?>
<?php
?>
<?php
include '../configuration/pied.php';
?>


