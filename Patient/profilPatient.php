<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}

 $idP_Patient = $_SESSION['idP_Patient'];
/*
$query = "SELECT * FROM patient WHERE idP_Patient = $idP_Patient";
$result = mysqli_query($connect, $query);
$patient = mysqli_fetch_assoc($result);
*/
$req="SELECT * FROM `patient` WHERE `idP_Patient`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idP_Patient);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    //$stmt->bind_result($id, $nom);
  $patient=  $stmt->fetch();
   // @$_SESSION['idP_Patient'] = $id;
   // @$_SESSION['nomP_Patient'] = $nom;
  //$medecin_id = $_POST['medecin_id'];
    $query = "SELECT m.idM_Medecin, m.nomM_Medecin as nomMed, rdv.dateR_RendezVous as date_rdv
          FROM rendezvous rdv
          JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
          WHERE rdv.idP_Patient = ?
          ORDER BY rdv.dateR_RendezVous DESC";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $idP_Patient);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<?php include '../configuration/headPatient.php';?>

    <h1>Bienvenue, <?php echo $_SESSION['nomP_Patient']; ?></h1>
<h1>Mes medecins</h1>
<?php if($result->num_rows > 0) { ?>
    <table class='table'>
        <thead class='table-dark'>
        <tr><th></th><th>Nom</th><th>Date de RENDEZ-VOUS</th><th>Details</th></tr>
        </thead>
        <?php $i=1;?>
        <?php while ($row = $result->fetch_assoc()) {?>
            <tr>
                <td><?php $i ?></td>
                <td><?= htmlspecialchars($row['nomMed']); ?></td>
                <td><?= htmlspecialchars($row['date_rdv']); ?></td>
                <td><form action=".php" method="post" style="display: inline;">
                        <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                        <button type="submit">Details</button>
                    </form>
                </td>
            </tr>
            <?php $i++;?>
            }
        <?php } ?>
    </table>
<?php }?>
    <!-- Modifier les informations personnelles du patient -->
    <h3>Modifier votre profil</h3>
    <form action="/Patient/modificationProfil.php" method="POST">
        <input type="text" name="nom" value="<?php echo $patient['nomP_Patient']; ?>" required>
        <input type="email" name="email" value="<?php echo $patient['emailP']; ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>

    <!--  gestions des documents du patient -->
    <h3>Vos documents</h3>
    <?php
   /*  $doc_query = "SELECT * FROM documents WHERE idP_Patient =$idP_Patient";
     $doc_result = mysqli_query($connect, $doc_query);*/
    $req="SELECT * FROM `documents` WHERE `idP_Patient`= ? ";
    $stmt = $connect->prepare($req);
    $stmt->bind_param("i", $idP_Patient);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $doc=  $stmt->fetch();
        echo "<div>";
        echo "<img src=".$doc['doc_path']."/>";
        echo "<form action='/Patient/supprimer_document.php' method='POST'>
              <div class='mb-3'>
                <input type='hidden' class='form-control'  name='document_id' value='" . @$doc['id'] . "'>
              </div>
              <button type='submit' class='btn btn-primary'>Supprimer ce document</button>
            </form>";
    }
    ?>
    <form action="/Patient/ajouter_document.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control"  name="document" required>
            <button type="submit" class="btn btn-primary">Ajouter ce document</button>
        </div>
    </form>


    <!-- Gestion des rendez-vous -->
    <h3>Mes rendez-vous</h3>
    <?php
    $rq = "SELECT * FROM rendezvous WHERE idP_Patient = $idP_Patient";
    $rdv_result = mysqli_query($connect, $rq);

    while ($rdv = mysqli_fetch_assoc($rdv_result)) {
        echo "<div>";
        echo "Date : " . @$rdv['dateR_RendezVous'] . "   type : " . @$rdv['type_RendezVous'];
        echo "<form action='/Patient/annulerRendezVous.php' method='POST'>
            <div class='mb-3'>
                <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
            </div>
            </form>";
   }
    ?>
<?php
include '../configuration/pied.php';
?>
