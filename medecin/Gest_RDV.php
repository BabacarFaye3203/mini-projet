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
<h1>Voici la liste de vos RDV </h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<?php echo "<div style='padding:10% 200px 0% 200px ;
                margin:8% 23px 10% auto ;'>";?>
<?php if($result->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Prénom</th><th>Date de RENDEZ-VOUS</th><th>Details</th></tr>
        </thead>
        <?php ?>
        <?php $i=0; while ($row = $result->fetch_assoc()) { $i++;
            echo "<tr>
            <td> $i</td>";?>
            <td><?= htmlspecialchars($row['nomPatient']); ?></td>
            <td><?= htmlspecialchars($row['pren']); ?></td>
            <td><?= htmlspecialchars($row['date_rdv']); ?></td>
            <td><form action="voirPatient.php" method="post" style="display: inline;">
                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                    <input type="submit" value="Details" class="btn btn-info" name="Detail">
                </form>
            </td>
            <?php echo "</tr>";?>
        <?php } ?>
    </table>
<?php }?>

<?php echo "</div>"?>
<?php
?>
<?php
include '../configuration/pied.php';
?>



