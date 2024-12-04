<?php
session_start();
@include '../database/DatabaseCreat.php';

//  si l'utilisateur est connecté
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['id_Medecin'];

/*$req="SELECT * FROM `medecin` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $med=  $stmt->fetch();
}
$query = "SELECT p.idP_Patient, p.nomP_Patient as nomPatient,p.emailP as mail,p.prenomP as pren,rdv.idP_Patient as idP,rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN patient p ON rdv.idP_Patient = p.idP_Patient
          WHERE rdv.idM_Medecin = ?
          GROUP BY p.idP_Patient";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$result = $stmt->get_result();
$result2=$result;*/

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
include '../configuration/headMedsous.php';
;?>
<h1>Voici la liste de vos RDV </h1>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >

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
                                <form action="voirPatient.php" method="post" class="d-inline">
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
                                <form action="voirPatient.php" method="post" class="d-inline">
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
                                <form action="voirPatient.php" method="post" class="d-inline">
                                    <input type="hidden" name="idP" value="<?= $row['id_Patient']; ?>">
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
include '../configuration/pied.php';
?>



