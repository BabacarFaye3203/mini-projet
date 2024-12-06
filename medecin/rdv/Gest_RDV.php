<?php
session_start();
@include '../../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['idM_Medecin'];

//****************--Selection des rendez-vous --******************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ? and rdv.statut='soumis' and rdv.origine='patient'
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
//****************--Selection des rendez-vous acceptés--***********************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ? and rdv.statut='accepté' and rdv.origine='patient'
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result2 = $stmt->get_result();
//****************--Selection des rendez-vous annulés--************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ? and rdv.statut='annulé' 
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result3 = $stmt->get_result();
//****************--Selection des rendez-vous reprogrammés--************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ? and rdv.statut='reprogrammé' 
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result4 = $stmt->get_result();
/*
//Suppression des rendez-vous ou la date limite est dépassée
$query_rendez_vous0 = "DELETE FROM rdva WHERE dat< LOCALTIME and idM = ?;";
$stmt_a = $connect->prepare($query_rendez_vous0);
$stmt_a->bind_param("i", $idM_Med);
$stmt_a->execute();

$query_rendez_vous0 = "DELETE FROM rdvn WHERE dat< LOCALTIME and idM = ?;";
$stmt_a = $connect->prepare($query_rendez_vous0);
$stmt_a->bind_param("i", $idM_Med);
$stmt_a->execute();
try {
    $connect->query($query);
}catch (Exception $e){
    exit();
}*/
?>
<?php //include '../configuration/headPatient.php';
include '../../configuration/head.php';
?>
<!--<div style='padding:10% 200px 0 650px ;margin:8% 23px 10% auto ;'>-->
<div class="container d-grid gap-2 my-4 ">
    <a class="btn btn-info" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        LISTE DES RDV
    </a>
</div>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <?php if ($result->num_rows > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; while ($row = $result->fetch_assoc()) { $i++; ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                            <td><?= htmlspecialchars($row['pren']); ?></td>
                            <td>
                                <form action="../patient/voirPatient.php" method="post" class="d-inline">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="Detail" value="Détails">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center text-muted">Aucun rendez-vous trouvé.</p>
        <?php } ?>
    </div>
</div>
<!--*********************--Rendez-vous acceptés--********************************-->
<section>
<div class="container d-grid gap-2 my-4">
    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
        Rendez-vous Acceptés
    </button>
</div>

<div class="collapse" id="collapseExample1">
    <div class="card card-body">
        <?php if ($result2->num_rows > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; while ($row = $result2->fetch_assoc()) { $i++; ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                            <td><?= htmlspecialchars($row['pren']); ?></td>
                            <td>
                                <form action="../patient/voirPatient.php" method="post" class="d-inline">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="DetailRDVA" value="Details" >
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center text-muted">Aucun rendez-vous accepté trouvé.</p>
        <?php } ?>
    </div>
</div></section>
<!--*********************--Rendez-vous annulés--*********************************-->
<section>
<div class="container d-grid gap-2 my-4">
    <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample1">
        Rendez-vous Annulés
    </button>
</div>

<div class="collapse" id="collapseExample2">
    <div class="card card-body">
        <?php if ($result3->num_rows > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; while ($row = $result3->fetch_assoc()) { $i++; ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                            <td><?= htmlspecialchars($row['pren']); ?></td>
                            <td>
                                <form action="../patient/voirPatient.php" method="post" class="d-inline">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="DetailRDVN" value="Details" >
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center text-muted">Aucun rendez-vous annulé trouvé.</p>
        <?php } ?>
    </div>
</div></section>
<!--*********************--Rendez-vous reprogrammés--*********************************-->
<section>
<div class="container d-grid gap-2 my-4">
    <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample1">
        Rendez-vous reprogrammés
    </button>
</div>

<div class="collapse" id="collapseExample3">
    <div class="card card-body">
        <?php if ($result4->num_rows > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; while ($row = $result4->fetch_assoc()) { $i++; ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($row['nomPatient']); ?></td>
                            <td><?= htmlspecialchars($row['pren']); ?></td>
                            <td>
                                <form action="../patient/voirPatient.php" method="post" class="d-inline">
                                    <input type="hidden" name="idP" value="<?= $row['idP_Patient']; ?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="DetailRDVR" value="Details" >
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center text-muted">Aucun rendez-vous re-programmé trouvé.</p>l
        <?php } ?>
    </div>
</div></section><!--</div>-->
<?php
?>
<?php
include '../../configuration/pied.php';
?>



