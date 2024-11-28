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
//Mise ajour des rendez-vous qui depasse la date prevue
   $query_rendez_vous0="DELETE FROM rendezvous WHERE dateR_RendezVous< LOCALTIME and idP_Patient = $idP;";
    if ($connect->query($query_rendez_vous0) === TRUE) {
        echo "Record deleted successfully";
    }
    // Récupérer les rendez-vous du patient
    $query_rendez_vous = "SELECT dateR_RendezVous as date_rdv, type_RendezVous as motif FROM rendezvous WHERE idP_Patient = ?";
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
                    <th>Date</th><th>Motif</th>
                </tr>
                </thead>
                <?php while ($row = $result_rendez_vous->fetch_assoc()){ ?>
                        <tr>
                    <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                    <td> <?= htmlspecialchars($row['motif']); ?></td>
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
