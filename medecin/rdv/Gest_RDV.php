<?php
session_start();
@include '../../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['idM_Medecin'];
/*
$req="SELECT * FROM `medecin` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $med=  $stmt->fetch();
}*/
//****************--Selection des rendez-vous --******************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
//****************--Selection des rendez-vous acceptés--***********************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP as idP,rdv.dat as date_rdv
          FROM rdva rdv
          JOIN patient p ON rdv.idP = p.idP_Patient
          WHERE rdv.idM = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result2 = $stmt->get_result();
//****************--Selection des rendez-vous annulés--************************
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP as idP,rdv.dat as date_rdv
          FROM rdvn rdv
          JOIN patient p ON rdv.idP = p.idP_Patient
          WHERE rdv.idM = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result3 = $stmt->get_result();
?>
<?php //include '../configuration/headPatient.php';
include '../../configuration/head.php';
?>
<div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
        <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false" disabled>Disabled</button>
        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
    </div>
</div>
<div style='padding:10% 200px 0% 650px ;margin:8% 23px 10% auto ;'>
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
                                    <button type="submit" class="btn btn-info btn-sm" name="Detail">Details</button>
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
                                    <button type="submit" class="btn btn-info btn-sm" name="DetailRDVA">Details</button>
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
</div>
<!--*********************--Rendez-vous acceptés--*********************************-->
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
                                    <button type="submit" class="btn btn-info btn-sm" name="DetailRDVA">Details</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center text-muted">Aucun rendez-vous annulé trouvé.</p>l
        <?php } ?>
    </div>
</div>
</div>
<?php
?>
<?php
include '../../configuration/pied.php';
?>


