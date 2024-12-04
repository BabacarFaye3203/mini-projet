<?php
session_start();
include "../database/DatabaseCreat.php"; // Connexion à la base de données
$result_rendez_vous=0;
$result_rendez_vous1=0;
$patient=false;
$idM=$_SESSION['id_Medecin'];
// Vérifier si un patient est spécifié
if (isset($_POST['Detail'])) {
    $idP = $_POST['idP'];

    // Récupérer les informations du patient
    $query_patient = "SELECT nomP_Patient, prenomP, ageP, emailP FROM patient WHERE idP_Patient = ?";
    $stmt_patient = $connect->prepare($query_patient);
    $stmt_patient->bind_param("i", $idP);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $patient = $result_patient->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as typ,
       dateR_RendezVous as date_rdv,idP_Patient ,type_RendezVous  as motif FROM rendezvous WHERE idP_Patient = ? and idM_Medecin=? order by dateR_RendezVous asc";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous = $stmt_rendez_vous->get_result();
}
else if(isset($_POST['DetailRDVA'])){
    $idP = $_POST['idP'];

    // Récupérer les informations du patient
    $query_patient = "SELECT nomP_Patient, prenomP, dat_naiss, emailP FROM patient WHERE idP_Patient = ?";
    $stmt_patient = $connect->prepare($query_patient);
    $stmt_patient->bind_param("i", $idP);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $patient = $result_patient->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT type,dat,
    idP,idM
    FROM rdva WHERE idP = ? and idM=?
    order by dat asc";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous1 = $stmt_rendez_vous->get_result();
}
else if(isset($_POST['DetailRDVN'])){
    $idP = $_POST['idP'];

    // Récupérer les informations du patient
    $query_patient = "SELECT nomP_Patient, prenomP, dat_naiss, emailP FROM patient WHERE idP_Patient = ?";
    $stmt_patient = $connect->prepare($query_patient);
    $stmt_patient->bind_param("i", $idP);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $patient = $result_patient->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT type,dat,
    idP,idM
    FROM rdvn WHERE idP = ? and idM=?
    order by dat asc";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous2 = $stmt_rendez_vous->get_result();
}
?>
<?php include '../configuration/headMedsous.php';?>
<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nomM_Medecin']); ?></h1>
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

<div style='padding:10% 200px 0% 200px ;
                margin:0% 23px 0% auto ;'>

    <h2>Informations sur le patient</h2>
    <?php if ($patient){ ?>
        <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nomP_Patient']); ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenomP']); ?></p>
        <p><strong>Age :</strong> <?= htmlspecialchars($patient['ageP']); ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($patient['emailP']); ?></p><br>



        <?php if (@$result_rendez_vous->num_rows > 0){ ?>
            <h3>Liste de tous les RDV</h3>
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>Date</th><th>Motif</th><th>Action</th>
                </tr>
                </thead>
                <?php while ($row = $result_rendez_vous->fetch_assoc()){ ?>
                        <tr>
                    <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                    <td> <?= htmlspecialchars($row['motif']); ?></td>
                            <td>
                                <form method="post" action="../acceptP.php">
                                    <input type="hidden" name="dat" value="<?= $row['date_rdv']; ?>">
                                    <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                    <input type="hidden" name="typ" value="<?= $row['typ']; ?>">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" value="Accepter" class="btn btn-success" name="Accepter">
                                </form>
                                <form action="../annulerRendezVous.php" method="post" style="display: inline;">
                                    <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                    <input type="hidden" name="typ" value="<?= $row['typ']; ?>">
                                    <input type="hidden" name="dat" value="<?= $row['date_rdv']; ?>">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Annuler
                                    </button>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <p>Veiller confirmer votre annulation du rendez-vous</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <input type="submit" value="Confirmer" class="btn btn-primary" name="Annuler">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                <?php } ?>
            </table>
            <?php } else if (@$result_rendez_vous1->num_rows > 0){ ?>
            <h3>Liste des RDV acceptés</h3>
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th>Date</th><th>Motif</th>
                    </tr>
                    </thead>
                    <?php while ($row = $result_rendez_vous1->fetch_assoc()){ ?>
                        <tr>
                            <td><?= htmlspecialchars($row['dat']); ?></td>
                            <td> <?= htmlspecialchars($row['type']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
    <?php } else if (@$result_rendez_vous2->num_rows > 0){ ?>
            <h3>Liste des RDV annulés ou a reprogrammés</h3>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>Date</th><th>Motif</th><th>Action</th>
        </tr>
        </thead>
        <?php while ($row = $result_rendez_vous2->fetch_assoc()){ ?>
        <form action="modifRDV.php" method="post">
            <tr>
                <input type="hidden" name="datA" value="<?= htmlspecialchars($row['dat']); ?>" >
                <input type="hidden" name="idP" value="<?= htmlspecialchars($row['idP']); ?>" >
                <td><input type="datetime-local" name="date_rdv" value="<?= htmlspecialchars($row['dat']); ?>" ></td>
                <input type="hidden" name="motif" value="<?= htmlspecialchars($row['type']); ?>">
                <td><?= htmlspecialchars($row['type']); ?></td>
                <td><input type="submit" class="btn btn-primary" name="modifRDV" value="Re-programmer"></td>
            </tr></form>
        <?php } ?>
    </table>
    <?php }}?>
</div>
</body>
<?php
include '../configuration/footer.php';
include '../configuration/piedindex.php';
?>
</html>