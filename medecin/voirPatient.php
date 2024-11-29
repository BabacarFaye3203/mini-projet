<?php
session_start();
include "../database/DatabaseCreat.php"; // Connexion à la base de données

// Vérifier si un patient est spécifié
if (isset($_POST['Detail'])) {
    $idP = $_POST['idP'];

    // Récupérer les informations du patient
    $query_patient = "SELECT nomP_Patient, prenomP, dat_naiss, emailP FROM patient WHERE idP_Patient = ?";
    $stmt_patient = $connect->prepare($query_patient);
    $stmt_patient->bind_param("i", $idP);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();
    $patient = $result_patient->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as typ,dateR_RendezVous as date_rdv,idP_Patient ,type_RendezVous  as motif FROM rendezvous WHERE idP_Patient = ?";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("i", $idP);
    $stmt_rendez_vous->execute();
    $result_rendez_vous = $stmt_rendez_vous->get_result();
} else {
    echo "Aucun patient sélectionné.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../configuration/headPatient.php';?>
    <h2>Détails du patient</h2>
    <?php if ($patient){ ?>
        <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nomP_Patient']); ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenomP']); ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['dat_naiss']); ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($patient['emailP']); ?></p><br>

        <h3>Rendez-vous</h3>

        <?php if ($result_rendez_vous->num_rows > 0){ ?>
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
                                <form method="post" action="acceptP.php">
                                    <input type="hidden" name="dat" value="<?= $row['date_rdv']; ?>">
                                    <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                    <input type="hidden" name="typ" value="<?= $row['typ']; ?>">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" value="Accepter" class="btn btn-success" name="Accepter">
                                </form>
                                <form action="annulerRendezVous.php" method="post" style="display: inline;">
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
        <?php }else{ ?>
            <p><script>window.alert("Aucun rendez-vous pour ce patient !!")</script></p>
        <?php } ?>
    <?php }else{ ?>
        <p><script>window.alert("Patient non trouvé !!")</script></p>
    <?php } ?>
</body>
<?php
include '../configuration/pied.php';
?>
</html>
