<?php
session_start();
@include '../database/DatabaseCreat.php';

//  si l'utilisateur est connecté
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
include '../configuration/headMedsous.php';
;?>
<h1>Voici la liste de vos RDV </h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<h1>Bienvenue, <?php echo $patient['nomP_Patient']." ".$patient['prenomP']; ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="../deconnexion.php">Medecin</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
        </div>
      </div>
    </div>
  </div>
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



