<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le medecin est connecté
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connPatient.php");
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
    $_SESSION['id_Medecin'] = $_SESSION['id_Medecin'];
    $_SESSION['nomM_Medecin'] = $_SESSION['nomM_Medecin'];
    
} else {
    echo "Aucun médecin trouvé avec cet identifiant.";
    exit();
}

// Récupérer la liste de tous les patients
$queryPatients = "SELECT idP_Patient, nomP_Patient, prenomP, email FROM patient";
$stmtPatients = $connect->prepare($queryPatients);
$stmtPatients->execute();
$resultPatients = $stmtPatients->get_result();

?>

<?php
//  l'en-tête de la page
include '../configuration/headMed.php';
?>

<h1>Bienvenue, Dr <?php echo htmlspecialchars($medecin['nomM_Medecin']); ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="../deconnexion.php">Se Déconnecter</a></li>
  </ul>
</div>

<section class="notrecouleur text-secondary px-1 py-2 text-center">
 <div >
    <div class="py-1" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
        </div>
      </div>
    </div>
  </div>


 </section>

<div style="padding: 10% 200px 0% 200px; margin: 0% 23px 10% auto;">
    <h1>Liste des patients</h1>
    <?php if ($resultPatients->num_rows>0) { ?>
        <table class="table" id="myPatients">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Prise de Rendez-vous</th>
                    <th>Voir_Profil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = $resultPatients->fetch_assoc()) {
                    $_SESSION["idP_Patient"]=$row["idP_Patient"];
                    $i++;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?=htmlspecialchars($row['nomP_Patient']); ?></td>
                        <td><?= htmlspecialchars($row['prenomP']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td>
                            <!-- Formulaire pour prendre rendez-vous rendez-vous avec le patient  -->
                            <form action="formRDVMed.php" method="post" style="display: inline;" >
                                <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                <input type="submit" class="btn btn-success" name="RDV" value="Planifier rendez-vous">
                            </form>
                            <?php
                                $rq = "SELECT idP_Patient, nomP_Patient, prenomP FROM Patient";
                                $resultP = $connect->query($rq);

                                if ($resultP->num_rows > 0) {
                                    if ($row = $resultP->fetch_assoc()) {
                                        echo " <td><a href='../patient/profilPatient.php?id=" . $row['idP_Patient'] . "' class='btn btn-primary'>Voir le profil</a></td>";
                                    }
                                } else {
                                    echo "<p>Aucun patient trouvé.</p>";
                                }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucun patient trouvé.</p>
    <?php } ?>

    <?php
// la liste des rendez-vous du médecin connecté
$queryRendezvous = "
    SELECT rdv.idR_RendezVous, rdv.dateR_RendezVous, p.nomP_Patient, p.prenomP, rdv.type_RendezVous,rdv.Lieu
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

// Modif la date d'un rendez-vous
if (isset($_POST['modifier_rdv'])) {
    $idRdv = $_POST['idRdv'];
    $nouvelle_date = $_POST['nouvelle_date'];
    $queryUpdate = "UPDATE RendezVous SET dateR_RendezVous = ? WHERE idR_RendezVous = ?";
    $stmtUpdate = $connect->prepare($queryUpdate);
    $stmtUpdate->bind_param("si", $nouvelle_date, $idRdv);
    $stmtUpdate->execute();
    echo "<p>La date du rendez-vous a été mise à jour avec succès.</p>";
}

// Supp un rendez-vous
if (isset($_POST['supprimer_rdv'])) {
    $idRdv = $_POST['idRdv'];
    $queryDelete = "DELETE FROM RendezVous WHERE idR_RendezVous = ?";
    $stmtDelete = $connect->prepare($queryDelete);
    $stmtDelete->bind_param("i", $idRdv);
    $stmtDelete->execute();
    echo "<p>Le rendez-vous a été supprimé définitivement.</p>";
}
?>


<?php


include '../configuration/footer.php';
?>
<?php
include '../configuration/pied.php';
?>


