<?php
session_start();
include "../../database/DatabaseCreat.php"; // Connexion à la base de données
$result_rendez_vous=0;
$result_rendez_vous1=0;
$patient=false;
$idM=$_SESSION['idM_Medecin'];
// Vérifier si un patient est spécifié
if (isset($_POST['Detail'])) {
    $idP = $_POST['idP'];
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as typ,
       dateR_RendezVous as date_rdv,idP_Patient ,type_RendezVous  as motif,lieu FROM rendezvous WHERE idP_Patient = ? and 
                idM_Medecin=? and statut='soumis'  order by dateR_RendezVous ";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous = $stmt_rendez_vous->get_result();
}
else if(isset($_POST['DetailRDVA'])){
    $idP = $_POST['idP'];
    // Récupérer les rendez-vous acceptes du patient
    $query_rendez_vous = "SELECT type_RendezVous,dateR_RendezVous,idP_Patient,idM_Medecin
    FROM rendezvous WHERE idP_Patient = ? and idM_Medecin=? and statut='accepté'
    order by dateR_RendezVous ";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous1 = $stmt_rendez_vous->get_result();
}
else if(isset($_POST['DetailRDVN'])){
    $idP = $_POST['idP'];
    // Récupérer les rendez-vous annules du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as type,dateR_RendezVous as dat
     ,idP_Patient,idM_Medecin,lieu
    FROM rendezvous WHERE idP_Patient = ? and idM_Medecin=? and statut='annulé'
    order by dateR_RendezVous ";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous2 = $stmt_rendez_vous->get_result();
}

// Récupérer les informations du patient
$query_patient = "SELECT nomP_Patient, prenomP, dat_naiss, emailP FROM patient WHERE idP_Patient = ?";
$stmt_patient = $connect->prepare($query_patient);
$stmt_patient->bind_param("i", $idP);
$stmt_patient->execute();
$result_patient = $stmt_patient->get_result();
$patient = $result_patient->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table{
            margin-right: 5px;
            text-align: center;
        }
    </style>
</head>
<?php include '../../configuration/patient/headPatient.php';?>
<body>
<div style='padding:10% 200px 0 200px ;
                margin:0 23px 0 auto ;'>

    <h2>Informations sur le patient</h2>
    <?php if ($patient){ ?>
        <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nomP_Patient']); ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenomP']); ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['dat_naiss']); ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($patient['emailP']); ?></p><br>


        <?php if (@$result_rendez_vous->num_rows > 0){ ?>
            <h3>Liste de tous les RDV</h3>
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>Date</th><th>Motif</th><th>Lieu</th><th>Action</th>
                </tr>
                </thead>
                <?php while ($row = $result_rendez_vous->fetch_assoc()){ ?>
                        <tr>
                    <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                    <td> <?= htmlspecialchars($row['motif']); ?></td>
                    <td> <?= htmlspecialchars($row['lieu']); ?></td>
                            <td>
                                <form method="post" action="../rdv/acceptP.php">
                                    <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                    <input type="submit" value="Accepter" class="btn btn-success" name="Accepter">
                                </form>
                                <form action="../rdv/annulerRendezVous.php" method="post" style="display: inline;">
                                    <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
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
            <th>Date</th><th>Motif</th><th>Lieu</th><th>Action</th>
        </tr>
        </thead>
        <?php while ($row = $result_rendez_vous2->fetch_assoc()){ ?>
        <form action="modifRDV.php" method="post">
            <tr>
                <input type="hidden" name="idr" value="<?= htmlspecialchars($row['idr']); ?>" >
                <td><input type="datetime-local" name="date_rdv" value="<?= htmlspecialchars($row['dat']); ?>" ></td>
                <input type="hidden" name="motif" value="<?= htmlspecialchars($row['type']); ?>">
                <td><?= htmlspecialchars($row['type']); ?></td>
                <td><input type="text" name="lieu" value="<?= htmlspecialchars($row['lieu']); ?>"></td>
                <td><input type="submit" class="btn btn-primary" name="modifRDV" value="Re-programmer"></td>
            </tr></form>
        <?php } ?>
    </table>
        <?php } else if (@$result_rendez_vous2->num_rows > 0){ ?>
            <h3>Liste des RDV reprogrammés</h3>
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>Date</th><th>Motif</th><th>Lieu</th><th>Action</th>
                </tr>
                </thead>
                <?php while ($row = $result_rendez_vous2->fetch_assoc()){ ?>
                    <form action="modifRDVP.php" method="post">
                        <tr>
                            <input type="hidden" name="idr" value="<?= htmlspecialchars($row['idr']); ?>" >
                            <td><input type="datetime-local" name="date_rdv" value="<?= htmlspecialchars($row['dat']); ?>" ></td>
                            <input type="hidden" name="motif" value="<?= htmlspecialchars($row['type']); ?>">
                            <td><input type="text" name="lieu" value="<?= htmlspecialchars($row['lieu']); ?>"></td>
                            <td><?= htmlspecialchars($row['type']); ?></td>
                            <td><input type="submit" class="btn btn-primary" name="modifRDV" value="Re-programmer"></td>
                        </tr></form>
                <?php } ?>
            </table>

        <?php }}?>
</div>
</body>
<?php
include '../../configuration/pied.php';
?>
</html>
