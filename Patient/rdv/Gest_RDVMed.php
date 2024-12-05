<?php
session_start();
@include '../../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}

$idP = $_SESSION['idP_Patient'];
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
$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.prenomM_Medecin as pren,rdv.idM_Medecin as idM,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ? and statut='soumis'
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP);
$stmt->execute();
$result = $stmt->get_result();
//****************--Selection des rendez-vous acceptés--***********************
$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.prenomM_Medecin as pren,rdv.idM_Medecin as idM,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ? and statut='accepté'
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP);
$stmt->execute();
$result2 = $stmt->get_result();
//****************--Selection des rendez-vous annulés--************************
$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.prenomM_Medecin as pren,rdv.idM_Medecin as idM,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ? and statut='annulé'
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP);
$stmt->execute();
$result3 = $stmt->get_result();
//****************--Selection des rendez-vous reprogrammés--************************
$query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed,m.prenomM_Medecin as pren,rdv.idM_Medecin as idM,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ? and statut='reprogrammé'
          GROUP BY m.idM_Medecin";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idP);
$stmt->execute();
$result2 = $stmt->get_result();
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
                            <td><?= htmlspecialchars($row['nomMed']); ?></td>
                            <td><?= htmlspecialchars($row['pren']); ?></td>
                            <td>
                                <form action="../docteur/voirMed.php" method="post" class="d-inline">
                                    <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
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
                                <td><?= htmlspecialchars($row['nomMed']); ?></td>
                                <td><?= htmlspecialchars($row['pren']); ?></td>
                                <td>
                                    <form action="../docteur/voirMed.php" method="post" class="d-inline">
                                        <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
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
                                <td><?= htmlspecialchars($row['nomMed']); ?></td>
                                <td><?= htmlspecialchars($row['pren']); ?></td>
                                <td>
                                    <form action="../docteur/voirMed.php" method="post" class="d-inline">
                                        <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                                        <button type="submit" class="btn btn-info btn-sm" name="DetailRDVN">Details</button>
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
                                <td><?= htmlspecialchars($row['nomMed']); ?></td>
                                <td><?= htmlspecialchars($row['pren']); ?></td>
                                <td>
                                    <form action="../docteur/voirMed.php" method="post" class="d-inline">
                                        <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                                        <button type="submit" class="btn btn-info btn-sm" name="DetailRDVN">Details</button>
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
    </div></section><!--</div>-->
<?php
?>
<?php
include '../../configuration/pied.php';
?>



