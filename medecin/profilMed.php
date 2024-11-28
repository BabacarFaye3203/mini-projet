<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté (si le médecin est connecté)
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

// Récupérer les informations du médecin connecté
$req = "SELECT * FROM `medecin` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $_SESSION['id_Medecin']);
$stmt->execute();
$resultMedecin = $stmt->get_result();
if ($resultMedecin->num_rows > 0) {
    $medecin = $resultMedecin->fetch_assoc();
} else {
    echo "Aucun médecin trouvé avec cet identifiant.";
    exit();
}

// Récupérer la liste de tous les patients
$queryPatients = "SELECT idP_Patient, nomP_Patient, prenomP, emailP FROM patient";
$stmtPatients = $connect->prepare($queryPatients);
$stmtPatients->execute();
$resultPatients = $stmtPatients->get_result();
?>

<?php
// Inclure l'en-tête de la page
include '../configuration/headMed.php';
?>

<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nomM_Medecin']); ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="deconnexion.php">Medecin</a></li>
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
<div style="padding: 10% 200px 0% 200px; margin: 8% 23px 10% auto;">
    <h1>Liste des patients</h1>
    <?php if ($resultPatients->num_rows > 0) { ?>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = $resultPatients->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($row['nomP_Patient']); ?></td>
                        <td><?= htmlspecialchars($row['prenomP']); ?></td>
                        <td><?= htmlspecialchars($row['emailP']); ?></td>
                        <td>
                            <form action="planifier_rendezVous.php" method="post" style="display: inline;">
                                <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucun patient trouvé.</p>
    <?php } ?>

    <?php
// Récupérer la liste des rendez-vous du médecin connecté
$queryRendezvous = "
    SELECT rdv.idR_RendezVous, rdv.dateR_RendezVous, p.nomP_Patient, p.prenomP, rdv.type_RendezVous
    FROM RendezVous rdv
    JOIN patient p ON rdv.idP_Patient = p.idP_Patient
    WHERE rdv.idM_Medecin = ?
    ORDER BY rdv.dateR_RendezVous DESC
";
$stmtRendezvous = $connect->prepare($queryRendezvous);
$stmtRendezvous->bind_param("i", $_SESSION['id_Medecin']);
$stmtRendezvous->execute();
$resultRendezvous = $stmtRendezvous->get_result();

// Annuler un rendez-vous
if (isset($_POST['annuler_rdv'])) {
    $idRdv = $_POST['idRdv'];
    $queryDelete = "DELETE FROM RendezVous WHERE idR_RendezVous = ?";
    $stmtDelete = $connect->prepare($queryDelete);
    $stmtDelete->bind_param("i", $idRdv);
    $stmtDelete->execute();
    echo "<p>Le rendez-vous a été annulé avec succès.</p>";
}

// Modifier la date d'un rendez-vous
if (isset($_POST['modifier_rdv'])) {
    $idRdv = $_POST['idRdv'];
    $nouvelle_date = $_POST['nouvelle_date'];

    // Mettre à jour la date du rendez-vous
    $queryUpdate = "UPDATE RendezVous SET dateR_RendezVous = ? WHERE idR_RendezVous = ?";
    $stmtUpdate = $connect->prepare($queryUpdate);
    $stmtUpdate->bind_param("si", $nouvelle_date, $idRdv);
    $stmtUpdate->execute();
    echo "<p>La date du rendez-vous a été mise à jour avec succès.</p>";
}

// Supprimer un rendez-vous
if (isset($_POST['supprimer_rdv'])) {
    $idRdv = $_POST['idRdv'];
    $queryDelete = "DELETE FROM RendezVous WHERE idR_RendezVous = ?";
    $stmtDelete = $connect->prepare($queryDelete);
    $stmtDelete->bind_param("i", $idRdv);
    $stmtDelete->execute();
    echo "<p>Le rendez-vous a été supprimé définitivement.</p>";
}
?>

<h1>Mes Rendez-vous</h1>

<?php if ($resultRendezvous->num_rows > 0) { ?>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom du patient</th>
                <th>Prénom du patient</th>
                <th>Date du rendez-vous</th>
                <th>Type de rendez-vous</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($rdv = $resultRendezvous->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= htmlspecialchars($rdv['nomP_Patient']); ?></td>
                    <td><?= htmlspecialchars($rdv['prenomP']); ?></td>
                    <td><?= htmlspecialchars($rdv['dateR_RendezVous']); ?></td>
                    <td><?= htmlspecialchars($rdv['type_RendezVous']); ?></td>
                    <td>
                        <!-- Formulaire pour annuler un rendez-vous -->
                        <form action="profilMed.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="submit" class="btn btn-warning" name="annuler_rdv" value="Annuler">
                        </form>

                        <!-- Formulaire pour modifier la date d'un rendez-vous -->
                        <form action="profilMed.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="datetime-local" name="nouvelle_date" class="form-control" required>
                            <input type="submit" class="btn btn-info" name="modifier_rdv" value="Modifier la date">
                        </form>

                        <!-- Formulaire pour supprimer un rendez-vous -->
                        <form action="profilMed.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="submit" class="btn btn-danger" name="supprimer_rdv" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Aucun rendez-vous prévu.</p>
<?php } ?>


<?php
// Inclure le pied de page (par exemple: copyright, scripts JS)
include '../configuration/pied.php';
?>


