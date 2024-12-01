<?php
session_start();
include "../database/DatabaseCreat.php"; // Connexion à la base de données
$result_rendez_vous=0;
$result_rendez_vous1=0;
$med=false;
$idP=$_SESSION['idP_Patient'];
// Vérifier si un patient est spécifié
if (isset($_POST['Detail'])) {
    $idM = $_POST['idM'];

    // Récupérer les informations du patient
    $query_med = "SELECT * FROM medecin WHERE idM_Medecin = ?";
    $stmt_med = $connect->prepare($query_med);
    $stmt_med->bind_param("i", $idM);
    $stmt_med->execute();
    $result_med = $stmt_med->get_result();
    $med = $result_med->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as typ,
       dateR_RendezVous as date_rdv,idM_Medecin ,type_RendezVous  as motif FROM rendezvous WHERE idP_Patient = ? and idM_Medecin=?";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous = $stmt_rendez_vous->get_result();
}
else if(isset($_POST['DetailRDVA'])){
    $idM = $_POST['idM'];

    // Récupérer les informations du patient
    $query_med = "SELECT * FROM medecin WHERE idM_Medecin = ?";
    $stmt_med = $connect->prepare($query_med);
    $stmt_med->bind_param("i", $idM);
    $stmt_med->execute();
    $result_med = $stmt_med->get_result();
    $med = $result_med->fetch_assoc();
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT idR_RendezVous as idr,type_RendezVous as typ,dateR_RendezVous as date_rdv,
    idP_Patient ,type_RendezVous  as motif 
    FROM rendezvous WHERE idP_Patient = ? and idM_Medecin=?";
    $stmt_rendez_vous = $connect->prepare($query_rendez_vous);
    $stmt_rendez_vous->bind_param("ii", $idP,$idM);
    $stmt_rendez_vous->execute();
    $result_rendez_vous1 = $stmt_rendez_vous->get_result();
}
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
<?php include '../configuration/headPatient.php';?>
<body>
<div style='padding:10% 200px 0 200px ;
                margin:0 23px 0 auto ;'>

    <h2>Informations sur le patient</h2>
    <?php if ($med){ ?>
        <p><strong>Nom :</strong> <?= htmlspecialchars($med['nomM_Medecin']); ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($med['prenomM_Medecin']); ?></p>
        <p><strong>Âge :</strong> <?= htmlspecialchars($med['age']); ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($med['emailM_Medecin']); ?></p><br>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($med['adresseM_Medecin']); ?></p><br>
        <p><strong>Spécialité :</strong> <?= htmlspecialchars($med['specialite_Medecin']); ?></p><br>
        <p><strong>Contact :</strong> <?= htmlspecialchars($med['contactM_Medecin']); ?></p><br>
        <p><strong>Sexe :</strong> <?= htmlspecialchars($med['sexe_Medecin']); ?></p><br>
        <h3>Rendez-vous</h3>

        <?php if (@$result_rendez_vous->num_rows > 0){ ?>
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
                            <form method="post" action="acceptM.php">
                                <input type="hidden" name="dat" value="<?= $row['date_rdv']; ?>">
                                <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                <input type="hidden" name="typ" value="<?= $row['typ']; ?>">
                                <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                                <input type="submit" value="Accepter" class="btn btn-success" name="Accepter">
                            </form>
                            <form action="annulerRendezVousM.php" method="post" style="display: inline;">
                                <input type="hidden" name="idr" value="<?= $row['idr']; ?>">
                                <input type="hidden" name="typ" value="<?= $row['typ']; ?>">
                                <input type="hidden" name="dat" value="<?= $row['date_rdv']; ?>">
                                <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">

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
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>Date</th><th>Motif</th>
                </tr>
                </thead>
                <?php while ($row = $result_rendez_vous1->fetch_assoc()){ ?>
                    <tr>
                        <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                        <td> <?= htmlspecialchars($row['motif']); ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php }else{ ?>
            <p><script>window.alert("Aucun rendez-vous pour ce medecin !!")</script></p>
        <?php } ?>
    <?php }else{ ?>
        <p><script>window.alert("Medecin non trouvé !!")</script></p>
    <?php } ?>
</div>
</body>
<?php
include '../configuration/pied.php';
?>
</html>
